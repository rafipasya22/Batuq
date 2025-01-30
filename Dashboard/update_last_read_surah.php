<?php
session_start();

if(isset($_POST['nama_surah'])) {
    // Simpan nama surah ke dalam sesi PHP
    $_SESSION['selected_surah'] = $_POST['nama_surah'];
    // Beri respons ke JavaScript bahwa data berhasil diterima
    echo "Data surah berhasil disimpan ke sesi PHP";
} else {
    // Beri respons ke JavaScript jika tidak ada data yang diterima
    echo "Tidak ada data surah yang diterima";
}
?>