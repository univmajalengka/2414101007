<?php
// Konfigurasi database
$server = "localhost";
$user = "root";
$password = ""; // PERBAIKAN: Password default XAMPP/WAMP biasanya kosong, sesuaikan jika berbeda
$nama_database = "pendaftaran_siswa";

// Membuat koneksi ke database
$db = mysqli_connect($server, $user, $password, $nama_database);

// Cek koneksi
if(!$db){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

// Set charset untuk mencegah masalah encoding
mysqli_set_charset($db, "utf8");
?>