<?php
// Include koneksi
include 'koneksi.php';

// Cek apakah koneksi berhasil
if (!isset($conn) || !$conn) {
    die("ERROR: Koneksi database gagal! Pastikan MySQL sudah running dan database sudah dibuat.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pemesan = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $nomor_hp = mysqli_real_escape_string($conn, $_POST['nomor_hp']);
    $tanggal_pesan = mysqli_real_escape_string($conn, $_POST['tanggal_pesan']);
    $waktu_perjalanan = intval($_POST['waktu_perjalanan']);
    $jumlah_peserta = intval($_POST['jumlah_peserta']);
    $harga_paket = floatval($_POST['harga_paket_hidden']);
    $jumlah_tagihan = floatval($_POST['jumlah_tagihan_hidden']);
    
    // Proses pelayanan dari checkbox
    $pelayanan_array = [];
    if (isset($_POST['pelayanan']) && is_array($_POST['pelayanan'])) {
        foreach ($_POST['pelayanan'] as $pel) {
            $pel_int = intval($pel);
            if ($pel_int == 1000000) {
                $pelayanan_array[] = 'Penginapan';
            } elseif ($pel_int == 1200000) {
                $pelayanan_array[] = 'Transportasi';
            } elseif ($pel_int == 500000) {
                $pelayanan_array[] = 'Service/Makan';
            }
        }
    }
    $pelayanan = implode(', ', $pelayanan_array);
    
    // Validasi server-side
    if (empty($nama_pemesan) || empty($nomor_hp) || empty($tanggal_pesan) || 
        $waktu_perjalanan <= 0 || empty($pelayanan) || $jumlah_peserta <= 0) {
        echo "<script>
                alert('Semua field harus diisi!');
                window.location.href = 'index.php';
              </script>";
        exit;
    }
    
    // Query insert
    $query = "INSERT INTO pesanan (nama_pemesan, nomor_hp, tanggal_pesan, waktu_perjalanan, pelayanan, jumlah_peserta, harga_paket, jumlah_tagihan) 
              VALUES ('$nama_pemesan', '$nomor_hp', '$tanggal_pesan', $waktu_perjalanan, '$pelayanan', $jumlah_peserta, $harga_paket, $jumlah_tagihan)";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Pemesanan berhasil disimpan!');
                window.location.href = 'modifikasi_pesanan.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan: " . mysqli_error($conn) . "');
                window.location.href = 'index.php';
              </script>";
    }
    
    mysqli_close($conn);
} else {
    header('Location: index.php');
    exit;
}
?>