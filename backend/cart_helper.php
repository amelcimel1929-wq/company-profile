<?php
/** Utilitas keranjang yang dipakai frontend. */
function ensureCartTables($koneksi) {
    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS carts (
        id_cart INT UNSIGNED NOT NULL AUTO_INCREMENT,
        id_user INT UNSIGNED NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id_cart),
        UNIQUE KEY uq_carts_user (id_user)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS cart_items (
        id_cart_item INT UNSIGNED NOT NULL AUTO_INCREMENT,
        id_cart INT UNSIGNED NOT NULL,
        id_product INT UNSIGNED NOT NULL,
        quantity INT UNSIGNED NOT NULL DEFAULT 1,
        PRIMARY KEY (id_cart_item),
        UNIQUE KEY uq_cart_product (id_cart, id_product),
        KEY idx_cart_items_product (id_product)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Kolom ini nyusul belakangan (produk flash sale bisa masuk keranjang) --
    // CREATE TABLE IF NOT EXISTS di atas gak nambahin kolom baru ke tabel yang
    // udah ada duluan, jadi di-ALTER manual di sini, aman dipanggil berkali-kali.
    $hasColumn = mysqli_query($koneksi, "SHOW COLUMNS FROM cart_items LIKE 'id_flash_sale'");
    if ($hasColumn && mysqli_num_rows($hasColumn) === 0) {
        mysqli_query($koneksi, "ALTER TABLE cart_items ADD COLUMN id_flash_sale INT UNSIGNED NULL AFTER id_product");
    }
}

function removeOutOfStockCartItems($koneksi, $idUser) {
    $stmt = mysqli_prepare($koneksi, 'DELETE ci FROM cart_items ci INNER JOIN carts c ON c.id_cart = ci.id_cart INNER JOIN products p ON p.id_product = ci.id_product WHERE c.id_user = ? AND p.stock <= 0');
    mysqli_stmt_bind_param($stmt, 'i', $idUser);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getCartItemCount($koneksi, $idUser) {
    ensureCartTables($koneksi);
    removeOutOfStockCartItems($koneksi, $idUser);
    $stmt = mysqli_prepare($koneksi, 'SELECT COALESCE(SUM(ci.quantity), 0) AS item_count FROM carts c INNER JOIN cart_items ci ON ci.id_cart = c.id_cart WHERE c.id_user = ?');
    mysqli_stmt_bind_param($stmt, 'i', $idUser);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int) ($row['item_count'] ?? 0);
}
