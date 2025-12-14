<?php
include 'koneksi.php';

// Proses Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = intval($_POST['id']);
    $nama_pemesan = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $nomor_hp = mysqli_real_escape_string($conn, $_POST['nomor_hp']);
    $tanggal_pesan = mysqli_real_escape_string($conn, $_POST['tanggal_pesan']);
    $waktu_perjalanan = intval($_POST['waktu_perjalanan']);
    $jumlah_peserta = intval($_POST['jumlah_peserta']);
    $harga_paket = floatval($_POST['harga_paket_hidden']);
    $jumlah_tagihan = floatval($_POST['jumlah_tagihan_hidden']);
    
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
    
    $query = "UPDATE pesanan SET 
              nama_pemesan = '$nama_pemesan',
              nomor_hp = '$nomor_hp',
              tanggal_pesan = '$tanggal_pesan',
              waktu_perjalanan = $waktu_perjalanan,
              pelayanan = '$pelayanan',
              jumlah_peserta = $jumlah_peserta,
              harga_paket = $harga_paket,
              jumlah_tagihan = $jumlah_tagihan
              WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pesanan berhasil diupdate!'); window.location.href='modifikasi_pesanan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Proses Hapus
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM pesanan WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pesanan berhasil dihapus!'); window.location.href='modifikasi_pesanan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = $id");
    $editData = mysqli_fetch_assoc($result);
}

// Ambil semua data pesanan
$query = "SELECT * FROM pesanan ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Wisata Jatitujuh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal.show {
            display: block;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 2% auto;
            padding: 0;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Header -->
    <header class="bg-white shadow-lg">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-2xl font-bold text-blue-600">Wisata Jatitujuh</span>
                </div>
                <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pesanan Paket Wisata</h1>
            
            <?php if (mysqli_num_rows($result) > 0): ?>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-blue-600 text-white">
                                <th class="border p-3 text-left">No</th>
                                <th class="border p-3 text-left">Nama Pemesan</th>
                                <th class="border p-3 text-left">No HP</th>
                                <th class="border p-3 text-left">Tanggal Pesan</th>
                                <th class="border p-3 text-left">Waktu (Hari)</th>
                                <th class="border p-3 text-left">Pelayanan</th>
                                <th class="border p-3 text-left">Peserta</th>
                                <th class="border p-3 text-left">Harga Paket</th>
                                <th class="border p-3 text-left">Total Tagihan</th>
                                <th class="border p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                            ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3"><?php echo $no++; ?></td>
                                <td class="border p-3"><?php echo htmlspecialchars($row['nama_pemesan']); ?></td>
                                <td class="border p-3"><?php echo htmlspecialchars($row['nomor_hp']); ?></td>
                                <td class="border p-3"><?php echo date('d/m/Y', strtotime($row['tanggal_pesan'])); ?></td>
                                <td class="border p-3"><?php echo $row['waktu_perjalanan']; ?></td>
                                <td class="border p-3"><?php echo htmlspecialchars($row['pelayanan']); ?></td>
                                <td class="border p-3"><?php echo $row['jumlah_peserta']; ?></td>
                                <td class="border p-3">Rp <?php echo number_format($row['harga_paket'], 0, ',', '.'); ?></td>
                                <td class="border p-3 font-bold text-green-600">Rp <?php echo number_format($row['jumlah_tagihan'], 0, ',', '.'); ?></td>
                                <td class="border p-3">
                                    <div class="flex gap-2 justify-center">
                                        <a href="?edit=<?php echo $row['id']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm font-semibold transition">
                                            Edit
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-semibold transition">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-500 mb-4">Silakan buat pesanan terlebih dahulu</p>
                    <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition inline-block">
                        Buat Pesanan
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php if ($editData): ?>
    <div id="modalEdit" class="modal show">
        <div class="modal-content">
            <div class="bg-yellow-500 text-white p-6 rounded-t-lg">
                <h2 class="text-3xl font-bold">Edit Pesanan</h2>
            </div>
            <div class="p-6">
                <form method="POST" onsubmit="return validateForm()">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Pemesan *</label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" value="<?php echo htmlspecialchars($editData['nama_pemesan']); ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <span class="text-red-500 text-sm hidden" id="error_nama">Nama pemesan harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor HP/Telp *</label>
                            <input type="text" name="nomor_hp" id="nomor_hp" value="<?php echo htmlspecialchars($editData['nomor_hp']); ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <span class="text-red-500 text-sm hidden" id="error_hp">Nomor HP harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal Pesan *</label>
                            <input type="date" name="tanggal_pesan" id="tanggal_pesan" value="<?php echo $editData['tanggal_pesan']; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <span class="text-red-500 text-sm hidden" id="error_tanggal">Tanggal pesan harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Waktu Pelaksanaan Perjalanan (Hari) *</label>
                            <input type="number" name="waktu_perjalanan" id="waktu_perjalanan" min="1" value="<?php echo $editData['waktu_perjalanan']; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" oninput="hitungTotal()">
                            <span class="text-red-500 text-sm hidden" id="error_waktu">Waktu perjalanan harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Pelayanan Paket Perjalanan *</label>
                            <?php
                            $pelayanan_selected = explode(', ', $editData['pelayanan']);
                            ?>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="pelayanan[]" value="1000000" class="mr-2 pelayanan-checkbox" onchange="hitungTotal()" <?php echo in_array('Penginapan', $pelayanan_selected) ? 'checked' : ''; ?>>
                                    <span>Penginapan (Rp 1.000.000)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="pelayanan[]" value="1200000" class="mr-2 pelayanan-checkbox" onchange="hitungTotal()" <?php echo in_array('Transportasi', $pelayanan_selected) ? 'checked' : ''; ?>>
                                    <span>Transportasi (Rp 1.200.000)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="pelayanan[]" value="500000" class="mr-2 pelayanan-checkbox" onchange="hitungTotal()" <?php echo in_array('Service/Makan', $pelayanan_selected) ? 'checked' : ''; ?>>
                                    <span>Service/Makan (Rp 500.000)</span>
                                </label>
                            </div>
                            <span class="text-red-500 text-sm hidden" id="error_pelayanan">Pilih minimal satu pelayanan</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Jumlah Peserta *</label>
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" min="1" value="<?php echo $editData['jumlah_peserta']; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" oninput="hitungTotal()">
                            <span class="text-red-500 text-sm hidden" id="error_peserta">Jumlah peserta harus diisi</span>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Harga Paket Perjalanan:</span>
                                <span id="harga_paket" class="font-bold text-yellow-600">Rp 0</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">Jumlah Tagihan:</span>
                                <span id="jumlah_tagihan" class="font-bold text-green-600 text-xl">Rp 0</span>
                            </div>
                        </div>

                        <input type="hidden" name="harga_paket_hidden" id="harga_paket_hidden">
                        <input type="hidden" name="jumlah_tagihan_hidden" id="jumlah_tagihan_hidden">

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold transition">
                                Update Pesanan
                            </button>
                            <a href="modifikasi_pesanan.php" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-3 rounded-lg font-semibold transition text-center">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function hitungTotal() {
            const checkboxes = document.querySelectorAll('.pelayanan-checkbox:checked');
            let hargaPaket = 0;
            
            checkboxes.forEach(checkbox => {
                hargaPaket += parseInt(checkbox.value);
            });

            const waktuPerjalanan = parseInt(document.getElementById('waktu_perjalanan').value) || 0;
            const jumlahPeserta = parseInt(document.getElementById('jumlah_peserta').value) || 0;
            
            const jumlahTagihan = waktuPerjalanan * jumlahPeserta * hargaPaket;

            document.getElementById('harga_paket').textContent = formatRupiah(hargaPaket);
            document.getElementById('jumlah_tagihan').textContent = formatRupiah(jumlahTagihan);
            document.getElementById('harga_paket_hidden').value = hargaPaket;
            document.getElementById('jumlah_tagihan_hidden').value = jumlahTagihan;
        }

        function validateForm() {
            let isValid = true;

            document.querySelectorAll('[id^="error_"]').forEach(el => {
                el.classList.add('hidden');
            });

            const nama = document.getElementById('nama_pemesan').value.trim();
            if (nama === '') {
                document.getElementById('error_nama').classList.remove('hidden');
                isValid = false;
            }

            const hp = document.getElementById('nomor_hp').value.trim();
            if (hp === '') {
                document.getElementById('error_hp').classList.remove('hidden');
                isValid = false;
            }

            const tanggal = document.getElementById('tanggal_pesan').value;
            if (tanggal === '') {
                document.getElementById('error_tanggal').classList.remove('hidden');
                isValid = false;
            }

            const waktu = document.getElementById('waktu_perjalanan').value;
            if (waktu === '' || waktu <= 0) {
                document.getElementById('error_waktu').classList.remove('hidden');
                isValid = false;
            }

            const checkboxes = document.querySelectorAll('.pelayanan-checkbox:checked');
            if (checkboxes.length === 0) {
                document.getElementById('error_pelayanan').classList.remove('hidden');
                isValid = false;
            }

            const peserta = document.getElementById('jumlah_peserta').value;
            if (peserta === '' || peserta <= 0) {
                document.getElementById('error_peserta').classList.remove('hidden');
                isValid = false;
            }

            if (!isValid) {
                alert('Mohon lengkapi semua data form pemesanan!');
            }

            return isValid;
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
                window.location.href = 'modifikasi_pesanan.php?delete=' + id;
            }
        }

        <?php if ($editData): ?>
        // Hitung total saat halaman edit dibuka
        window.onload = function() {
            hitungTotal();
        };
        <?php endif; ?>
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>