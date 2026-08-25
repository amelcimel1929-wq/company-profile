<?php
include "connection.php";

// =====================================================================
// Generate XLSX ASLI tanpa library (PhpSpreadsheet, dll) -- cukup pakai
// ZipArchive bawaan PHP. Format .xlsx itu sebenernya cuma file .zip
// isinya beberapa XML (spec-nya disebut OOXML SpreadsheetML). Butuh
// ext-zip aktif di PHP -- sudah ditambahin ke docker/php/Dockerfile,
// jadi kalau masih error "Class ZipArchive not found", rebuild image-nya:
//   docker compose up -d --build web
// =====================================================================

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    die('Extension "zip" belum aktif di PHP. Rebuild image PHP dulu: docker compose up -d --build web');
}

// 1. Ambil data -- sama persis query-nya dgn tabel_orders.php, tapi
//    tanpa pagination (export selalu ambil SEMUA baris yg cocok filter).
$filter_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

$where_clause = "";
if (!empty($filter_tanggal)) {
    $tanggal_aman = mysqli_real_escape_string($koneksi, $filter_tanggal);
    $where_clause = " WHERE DATE(orders.order_date) = '$tanggal_aman' ";
}

$query = "SELECT orders.*, users.name AS customer_name
          FROM orders
          JOIN users ON orders.id_user = users.id_user
          $where_clause
          ORDER BY orders.id_order DESC";

$result = mysqli_query($koneksi, $query);
$rows = [];
if ($result) {
    while ($order = mysqli_fetch_object($result)) {
        $rows[] = [
            $order->order_code,
            $order->customer_name,
            !empty($order->no_telepon) ? $order->no_telepon : '-',
            date('d-m-Y H:i', strtotime($order->order_date)),
            'Rp ' . number_format($order->total_price, 0, ',', '.'),
            $order->status,
        ];
    }
}

$headers = ['Kode Pesanan', 'Nama Customer', 'No. Telepon', 'Tanggal Pesan', 'Total Harga', 'Status'];
$colWidths = [18, 26, 16, 18, 16, 16]; // A..F, dlm satuan "karakter" Excel

// Excel butuh teks di-escape XML (&, <, >, kutip) -- inline string, 

// gak perlu file sharedStrings.xml terpisah.
function xl_esc($str)
{
    return htmlspecialchars((string) $str, ENT_QUOTES | ENT_XML1, 'UTF-8');
}

function xl_col($idx) // 0-based -> "A".."Z".."AA" dst
{
    $idx++;
    $letter = '';
    while ($idx > 0) {
        $rem = ($idx - 1) % 26;
        $letter = chr(65 + $rem) . $letter;
        $idx = intdiv($idx - 1, 26);
    }
    return $letter;
}

function xl_cell($col, $row, $value, $styleIndex)
{
    return '<c r="' . $col . $row . '" t="inlineStr" s="' . $styleIndex . '"><is><t xml:space="preserve">'
        . xl_esc($value) . '</t></is></c>';
}

// 2. Bangun xl/worksheets/sheet1.xml
$lastRow = count($rows) + 1;
$lastCol = xl_col(count($headers) - 1);

$colsXml = '<cols>';
foreach ($colWidths as $i => $w) {
    $c = $i + 1;
    $colsXml .= '<col min="' . $c . '" max="' . $c . '" width="' . $w . '" customWidth="1"/>';
}
$colsXml .= '</cols>';

$sheetDataXml = '<sheetData>';

// baris header -- style s="1" (bold + fill pink, lihat styles.xml)
$sheetDataXml .= '<row r="1">';
foreach ($headers as $i => $label) {
    $sheetDataXml .= xl_cell(xl_col($i), 1, $label, 1);
}
$sheetDataXml .= '</row>';

// baris data -- style s="0" (normal + border)
foreach ($rows as $r => $row) {
    $rNum = $r + 2;
    $sheetDataXml .= '<row r="' . $rNum . '">';
    foreach ($row as $i => $val) {
        $sheetDataXml .= xl_cell(xl_col($i), $rNum, $val, 0);
    }
    $sheetDataXml .= '</row>';
}
if (empty($rows)) {
    $sheetDataXml .= '<row r="2">' . xl_cell('A', 2, 'Tidak ada data pesanan untuk tanggal ini.', 0) . '</row>';
    $lastRow = 2;
}
$sheetDataXml .= '</sheetData>';

$sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
    . '<dimension ref="A1:' . $lastCol . $lastRow . '"/>'
    . '<sheetViews><sheetView workbookViewId="0"/></sheetViews>'
    . '<sheetFormatPr defaultRowHeight="15"/>'
    . $colsXml
    . $sheetDataXml
    . '</worksheet>';

// 3. Bagian-bagian XML lain (fixed, gak tergantung data)
$contentTypesXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
    . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
    . '<Default Extension="xml" ContentType="application/xml"/>'
    . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
    . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
    . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
    . '</Types>';

$rootRelsXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
    . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
    . '</Relationships>';

$workbookXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
    . '<sheets><sheet name="Daftar Pesanan" sheetId="1" r:id="rId1"/></sheets>'
    . '</workbook>';

$workbookRelsXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
    . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
    . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
    . '</Relationships>';

// style s="0" = sel biasa (border tipis abu2); style s="1" = header (bold, warna #7d5260, fill #fce8f0)
$stylesXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
    . '<fonts count="2">'
    . '<font><sz val="11"/><name val="Calibri"/></font>'
    . '<font><b/><sz val="11"/><color rgb="FF7D5260"/><name val="Calibri"/></font>'
    . '</fonts>'
    . '<fills count="3">'
    . '<fill><patternFill patternType="none"/></fill>'
    . '<fill><patternFill patternType="gray125"/></fill>'
    . '<fill><patternFill patternType="solid"><fgColor rgb="FFFCE8F0"/><bgColor indexed="64"/></patternFill></fill>'
    . '</fills>'
    . '<borders count="2">'
    . '<border><left/><right/><top/><bottom/><diagonal/></border>'
    . '<border><left style="thin"><color rgb="FFCCCCCC"/></left><right style="thin"><color rgb="FFCCCCCC"/></right><top style="thin"><color rgb="FFCCCCCC"/></top><bottom style="thin"><color rgb="FFCCCCCC"/></bottom><diagonal/></border>'
    . '</borders>'
    . '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
    . '<cellXfs count="2">'
    . '<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1"/>'
    . '<xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1"/>'
    . '</cellXfs>'
    . '<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles>'
    . '</styleSheet>';

// 4. Rakit file .xlsx (zip) via file sementara -- ZipArchive butuh path fisik
$tmpPath = tempnam(sys_get_temp_dir(), 'xlsx_');
$zip = new ZipArchive();
$zip->open($tmpPath, ZipArchive::OVERWRITE);
$zip->addFromString('[Content_Types].xml', $contentTypesXml);
$zip->addFromString('_rels/.rels', $rootRelsXml);
$zip->addFromString('xl/workbook.xml', $workbookXml);
$zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRelsXml);
$zip->addFromString('xl/styles.xml', $stylesXml);
$zip->addFromString('xl/worksheets/sheet1.xml', $sheetXml);
$zip->close();

$xlsxData = file_get_contents($tmpPath);
unlink($tmpPath);

// 5. Nama file & headers download -- pola nama sama kayak sebelumnya
$tanggal_export = date('Y-m-d_His');
$nama_file = 'daftar_pesanan'
    . (!empty($filter_tanggal) ? '_filter-' . $filter_tanggal : '')
    . '_export-' . $tanggal_export
    . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $nama_file . '"');
header('Content-Length: ' . strlen($xlsxData));
header('Cache-Control: private, max-age=0, must-revalidate');
echo $xlsxData;
exit;
