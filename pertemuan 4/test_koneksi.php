<?php
echo "<h2>Test Koneksi Database</h2>";

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wisata_jatitujuh';

echo "1. Mencoba koneksi...<br>";
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "❌ KONEKSI GAGAL: " . mysqli_connect_error() . "<br>";
    die();
} else {
    echo "✅ KONEKSI BERHASIL!<br>";
    echo "Database: " . $database . "<br>";
}

// Test query
$query = "SELECT * FROM pesanan LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "✅ Query berhasil dijalankan!<br>";
    echo "Jumlah data: " . mysqli_num_rows($result) . "<br>";
} else {
    echo "❌ Query gagal: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>