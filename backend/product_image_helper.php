<?php
// Helper upload galeri foto produk -- dipakai bareng di action_insert_produk.php,
// action_update_produk.php, action_delete_product_image.php.

const PRODUCT_IMAGE_MAX = 5;
const PRODUCT_IMAGE_MIN = 1;

/**
 * Normalisasi array $_FILES['images'] (struktur "banyak file, 1 field") jadi
 * list per-file yg gampang di-loop. PHP nyimpen multi-upload dgn field yg
 * sama sebagai array-of-array per-attribute (name[], tmp_name[], dst),
 * bukan array-of-file -- fungsi ini yg susun ulang jadi array-of-file.
 */
function normalize_uploaded_files($filesField)
{
    $list = [];
    if (empty($filesField['name']) || !is_array($filesField['name'])) {
        return $list;
    }
    foreach ($filesField['name'] as $i => $name) {
        if ($name === '' || $filesField['error'][$i] === UPLOAD_ERR_NO_FILE) {
            continue; // slot kosong (input file yg gak diisi)
        }
        $list[] = [
            'name'     => $name,
            'tmp_name' => $filesField['tmp_name'][$i],
            'error'    => $filesField['error'][$i],
        ];
    }
    return $list;
}

/**
 * Upload sekumpulan file ke folder "foto/" dgn nama unik. Return array nama
 * file baru yg berhasil diupload. Kalau ada satu aja yg gagal, file yg
 * sudah kepalang keupload dihapus lagi (rollback) & function return false --
 * biar gak nyisain foto "nyantol" tanpa baris DB kalau upload gagal di tengah.
 */
function upload_product_images(array $fileList, string $folder = 'foto/')
{
    $uploaded = [];
    foreach ($fileList as $i => $file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            foreach ($uploaded as $f) {
                @unlink($folder . $f);
            }
            return false;
        }
        // time() doang bisa bentrok kalau beberapa file keupload di detik yg
        // sama -- tambahin index urutan biar nama filenya selalu unik.
        $new_filename = time() . '_' . $i . '_' . $file['name'];
        if (!move_uploaded_file($file['tmp_name'], $folder . $new_filename)) {
            foreach ($uploaded as $f) {
                @unlink($folder . $f);
            }
            return false;
        }
        $uploaded[] = $new_filename;
    }
    return $uploaded;
}

/**
 * Sinkronkan products.image (foto cover/utama, dipakai di semua tempat yg
 * cuma nampilin 1 foto -- tabel produk admin, kartu produk, dst) supaya
 * selalu sama dgn foto ber-sort_order terkecil di product_images.
 * Dipanggil tiap kali galeri berubah (tambah/hapus foto).
 */
function sync_primary_product_image($koneksi, $id_product)
{
    $id_product = (int) $id_product;
    $res = mysqli_query($koneksi, "SELECT image FROM product_images WHERE id_product = $id_product ORDER BY sort_order ASC, id_image ASC LIMIT 1");
    $row = $res ? mysqli_fetch_assoc($res) : null;
    if ($row) {
        $image_aman = mysqli_real_escape_string($koneksi, $row['image']);
        mysqli_query($koneksi, "UPDATE products SET image = '$image_aman' WHERE id_product = $id_product");
    }
}
