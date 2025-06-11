<?php
// Script untuk mengunduh gambar illustrasi login jika tidak tersedia
$imageUrl = 'https://img.freepik.com/free-vector/choosing-best-online-restaurant-menu-tiny-people-ordering-dishes-digital-menu-with-qr-code-online-restaurant-menu-qr-code-scanning-concept_335657-2358.jpg';
$savePath = __DIR__ . '/css/login_illustration.jpg';

// Buat direktori jika belum ada
if (!file_exists(dirname($savePath))) {
    mkdir(dirname($savePath), 0777, true);
}

// Coba unduh gambar
$imageContent = @file_get_contents($imageUrl);
if ($imageContent !== false) {
    file_put_contents($savePath, $imageContent);
    echo "Gambar ilustrasi berhasil diunduh!";
} else {
    echo "Gagal mengunduh gambar ilustrasi. Pastikan server memiliki akses internet atau coba unduh manual.";
}
?>
