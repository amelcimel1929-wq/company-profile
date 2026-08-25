<?php
include "connection.php";

// =====================================================================
// Generate PDF TANPA library eksternal (no Composer, no vendor).
// PDF adalah format berbasis teks -- buat dokumen tabel sesimpel ini,
// kita bisa nulis langsung struktur objek PDF-nya dari PHP.
// =====================================================================

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

// 2. Helper teks -- font standar PDF (Helvetica) cuma support 1-byte
//    encoding (WinAnsi/CP1252), bukan UTF-8. Semua string wajib lewat
//    fungsi ini dulu sebelum ditulis ke content stream.
function pdf_txt($str)
{
    $str = (string) $str;
    if (function_exists('iconv')) {
        $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', $str);
        if ($converted !== false) {
            return $converted;
        }
    }
    return $str;
}

// Escape karakter spesial PDF string: backslash & tanda kurung.
function pdf_esc($str)
{
    return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $str);
}

// Potong teks kasar (perkiraan lebar karakter Helvetica ~0.5*fontsize)
// biar gak numpuk ke kolom sebelah -- gak presisi 100% (raw PDF gak
// punya cara ngukur lebar teks tanpa tabel metrik font), tapi cukup
// aman buat kolom-kolom tabel ini.
function pdf_fit($str, $maxWidthPt, $fontSize = 9)
{
    $txt = pdf_txt($str);
    $maxChars = max(1, (int) floor($maxWidthPt / ($fontSize * 0.52)));
    if (strlen($txt) > $maxChars) {
        $txt = substr($txt, 0, max(1, $maxChars - 1)) . '.';
    }
    return pdf_esc($txt);
}

// 3. Layout
$pageW = 595;
$pageH = 842;
$marginL = 40;
$tableRight = 555; // marginL + usable width (515)
$colWidths = [85, 120, 75, 90, 85, 60]; // total = 515
$colLabels = ['Kode Pesanan', 'Nama Customer', 'No. Telepon', 'Tanggal Pesan', 'Total Harga', 'Status'];

$colX = [];
$x = $marginL;
foreach ($colWidths as $w) {
    $colX[] = $x;
    $x += $w;
}

$titleBaselineY = 800;
$metaBaselineY = 782;
$tableTop = 764;      // tepi atas baris header kolom
$headerRowH = 20;
$dataRowH = 16;
$bottomLimit = 50;    // baris gak boleh turun di bawah y ini
$footerY = 30;

$rowsPerPage = max(1, (int) floor(($tableTop - $headerRowH - $bottomLimit) / $dataRowH));
$totalRows = count($rows);
$totalPages = max(1, (int) ceil($totalRows / $rowsPerPage));
$pageChunks = $totalRows > 0 ? array_chunk($rows, $rowsPerPage) : [[]];

$metaText = (!empty($filter_tanggal) ? 'Filter tanggal: ' . $filter_tanggal . '   -   ' : '')
    . 'Dicetak: ' . date('d-m-Y H:i');

// 4. Bangun content stream tiap halaman
function build_page_stream($pageRows, $pageNum, $totalPages, $colX, $colWidths, $colLabels, $metaText, $vars)
{
    extract($vars);
    $s = "q\n";

    // Judul
    $s .= "0.490 0.322 0.376 rg\n";
    $s .= "BT /F2 16 Tf {$marginL} {$titleBaselineY} Td (" . pdf_esc(pdf_txt('Daftar Pesanan')) . ") Tj ET\n";

    // Meta (filter + tanggal cetak)
    $s .= "0.45 0.45 0.45 rg\n";
    $s .= "BT /F1 9 Tf {$marginL} {$metaBaselineY} Td (" . pdf_esc(pdf_txt($metaText)) . ") Tj ET\n";

    // Baris header kolom -- background pink
    $headerBottom = $tableTop - $headerRowH;
    $s .= "0.988 0.910 0.941 rg\n";
    $s .= "{$marginL} {$headerBottom} {$tableWidth} {$headerRowH} re f\n";

    $s .= "0.490 0.322 0.376 rg\n";
    $headerTextY = $headerBottom + 6;
    foreach ($colLabels as $i => $label) {
        $tx = $colX[$i] + 4;
        $s .= "BT /F2 9 Tf {$tx} {$headerTextY} Td (" . pdf_fit($label, $colWidths[$i] - 8) . ") Tj ET\n";
    }

    // Baris data
    $s .= "0.25 0.25 0.25 rg\n";
    $rowTop = $headerBottom;
    foreach ($pageRows as $row) {
        $rowBottom = $rowTop - $dataRowH;
        $textY = $rowBottom + 4;
        foreach ($row as $i => $val) {
            $tx = $colX[$i] + 4;
            $s .= "BT /F1 9 Tf {$tx} {$textY} Td (" . pdf_fit($val, $colWidths[$i] - 8) . ") Tj ET\n";
        }
        $rowTop = $rowBottom;
    }
    if (empty($pageRows)) {
        $s .= "BT /F1 9 Tf {$marginL} " . ($rowTop - $dataRowH + 4) . " Td (" . pdf_esc(pdf_txt('Tidak ada data pesanan untuk tanggal ini.')) . ") Tj ET\n";
        $rowTop -= $dataRowH;
    }
    $tableBottom = $rowTop;

    // Grid (garis horizontal & vertikal)
    $s .= "0.8 0.8 0.8 RG 0.5 w\n";
    // horizontal: atas header, bawah header, tiap baris data
    $hLines = [$tableTop, $headerBottom];
    $y = $headerBottom;
    $count = count($pageRows) > 0 ? count($pageRows) : 1;
    for ($i = 0; $i < $count; $i++) {
        $y -= $dataRowH;
        $hLines[] = $y;
    }
    foreach ($hLines as $ly) {
        $s .= "{$marginL} {$ly} m {$tableRight} {$ly} l S\n";
    }
    // vertical: tiap batas kolom
    $vXs = $colX;
    $vXs[] = $tableRight;
    foreach ($vXs as $vx) {
        $s .= "{$vx} {$tableTop} m {$vx} {$tableBottom} l S\n";
    }

    // Footer
    $s .= "0.55 0.55 0.55 rg\n";
    $s .= "BT /F1 8 Tf {$marginL} {$footerY} Td (" . pdf_esc(pdf_txt("Halaman {$pageNum} / {$totalPages}")) . ") Tj ET\n";

    $s .= "Q\n";
    return $s;
}

$tableWidth = $tableRight - $marginL;
$vars = compact('marginL', 'tableRight', 'tableWidth', 'titleBaselineY', 'metaBaselineY', 'tableTop', 'headerRowH', 'dataRowH', 'bottomLimit', 'footerY');

// 5. Rakit file PDF mentah (header, objects, xref, trailer)
$objects = []; // index 1..N => string isi object (tanpa "N 0 obj"/"endobj")
$objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
$objects[3] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>";
$objects[4] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>";

$kids = [];
$nextObjNum = 5;
foreach ($pageChunks as $idx => $pageRows) {
    $pageObjNum = $nextObjNum++;
    $contentObjNum = $nextObjNum++;
    $kids[] = $pageObjNum;

    $stream = build_page_stream($pageRows, $idx + 1, $totalPages, $colX, $colWidths, $colLabels, $metaText, $vars);
    $streamLen = strlen($stream);

    $objects[$pageObjNum] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$pageW} {$pageH}] "
        . "/Resources << /Font << /F1 3 0 R /F2 4 0 R >> >> /Contents {$contentObjNum} 0 R >>";
    $objects[$contentObjNum] = ['stream' => $stream, 'len' => $streamLen];
}

$kidsRefs = implode(' ', array_map(fn($n) => "{$n} 0 R", $kids));
$objects[2] = "<< /Type /Pages /Kids [{$kidsRefs}] /Count " . count($kids) . " >>";

ksort($objects);

$pdfBody = "%PDF-1.4\n";
$offsets = [];
foreach ($objects as $num => $content) {
    $offsets[$num] = strlen($pdfBody);
    if (is_array($content)) {
        $pdfBody .= "{$num} 0 obj\n<< /Length {$content['len']} >>\nstream\n{$content['stream']}\nendstream\nendobj\n";
    } else {
        $pdfBody .= "{$num} 0 obj\n{$content}\nendobj\n";
    }
}

$maxObj = max(array_keys($objects));
$xrefOffset = strlen($pdfBody);
$pdfBody .= "xref\n0 " . ($maxObj + 1) . "\n";
$pdfBody .= "0000000000 65535 f \n";
for ($n = 1; $n <= $maxObj; $n++) {
    $pdfBody .= sprintf("%010d 00000 n \n", $offsets[$n]);
}
$pdfBody .= "trailer\n<< /Size " . ($maxObj + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF";

// 6. Nama file & headers download -- pola nama sama kayak export Excel.
$tanggal_export = date('Y-m-d_His');
$nama_file = 'daftar_pesanan'
    . (!empty($filter_tanggal) ? '_filter-' . $filter_tanggal : '')
    . '_export-' . $tanggal_export
    . '.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $nama_file . '"');
header('Content-Length: ' . strlen($pdfBody));
header('Cache-Control: private, max-age=0, must-revalidate');
echo $pdfBody;
exit;
