<?php
// Data Paket Wisata
$paketWisata = [
    [
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbmY_DQnUxflEayxJcHGPRG3X7nMT3JAd3xw&s',
        'judul' => 'Tiket Masuk Bendung Rentang',
        'deskripsi' => 'Menawarkan pemandangan indah bendungan dengan area hijau yang asri, cocok untuk piknik keluarga dan menikmati suasana pedesaan yang tenang.',
        'video_id' => 'wuuRIhaNvGY'
    ],
    [
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyWONG2zUy7iKKGUyp-e8euX26BqFhd8L1Cg&s',
        'judul' => 'Taman Rentang Jatitujuh',
        'deskripsi' => 'Taman segar yang cocok untuk tempat kumpul keluarga dengan berbagai fasilitas rekreasi.',
        'video_id' => 'wuuRIhaNvGY'
    ],
    [
        'image' => 'https://asset-2.tstatic.net/travel/foto/bank/images/Kanal-Cipelang-Majalengka.jpg',
        'judul' => 'Paket Perahu Sungai Cipelang',
        'deskripsi' => 'Jelajahi keindahan sungai dengan perahu tradisional dan nikmati udara segar pedesaan.',
        'video_id' => 'wuuRIhaNvGY'
    ]
];

$bannerImages = [
    'https://cdn0-production-images-kly.akamaized.net/CKBwr73tZD7294UwaQ-Zh6quils=/500x281/smart/filters:quality(75):strip_icc()/kly-media-production/medias/2510125/original/061516100_1543494559-Kawasan_Pabrik_Gula_Jatitujuh.jpg',
    'https://fajarcirebon.com/wp-content/uploads/2025/01/IMG-20250131-WA0042.jpg',
    'https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2021/12/31/1733798750.jpg'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Jatitujuh - UMKM Pariwisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        .banner-image {
            transition: opacity 1s ease-in-out;
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Modal Styles */
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

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Header & Navbar -->
    <header class="bg-white shadow-lg fixed w-full top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-2xl font-bold text-blue-600">Wisata Jatitujuh</span>
                </div>
                
                <ul class="hidden md:flex space-x-8 text-gray-700 font-medium">
                    <li><a href="#beranda" class="hover:text-blue-600 transition">Beranda</a></li>
                    <li><a href="#paket-wisata" class="hover:text-blue-600 transition">Paket Wisata</a></li>
                    <li><a href="modifikasi_pesanan.php" class="hover:text-blue-600 transition">Daftar Pesanan</a></li>
                </ul>
                
                <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <ul id="mobile-menu" class="hidden md:hidden mt-4 space-y-2 text-gray-700 font-medium">
                <li><a href="#beranda" class="block py-2 hover:text-blue-600 transition">Beranda</a></li>
                <li><a href="#paket-wisata" class="block py-2 hover:text-blue-600 transition">Paket Wisata</a></li>
                <li><a href="modifikasi_pesanan.php" class="block py-2 hover:text-blue-600 transition">Daftar Pesanan</a></li>
            </ul>
        </nav>
    </header>

    <!-- Banner Carousel -->
    <section id="beranda" class="relative h-screen mt-16">
        <div class="relative h-full overflow-hidden">
            <?php foreach ($bannerImages as $index => $image): ?>
                <div class="banner-image absolute inset-0 <?php echo $index === 0 ? 'opacity-100' : 'opacity-0'; ?>" data-banner="<?php echo $index; ?>">
                    <img src="<?php echo $image; ?>" alt="Banner <?php echo $index + 1; ?>" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                </div>
            <?php endforeach; ?>
            
            <div class="absolute inset-0 flex items-center justify-center text-white text-center px-4">
                <div class="animate-slide-in">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Jelajahi Keindahan Jatitujuh</h1>
                    <p class="text-xl md:text-2xl mb-8">Temukan destinasi wisata terbaik dan pengalaman tak terlupakan</p>
                    <a href="#paket-wisata" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition inline-block">
                        Lihat Paket Wisata
                    </a>
                </div>
            </div>
            
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3">
                <?php foreach ($bannerImages as $index => $image): ?>
                    <button class="banner-dot w-3 h-3 rounded-full <?php echo $index === 0 ? 'bg-white' : 'bg-white bg-opacity-50'; ?>" data-dot="<?php echo $index; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Paket Wisata Section -->
    <section id="paket-wisata" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Paket Wisata Kami</h2>
                <p class="text-lg text-gray-600">Pilih paket wisata terbaik sesuai dengan keinginan Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($paketWisata as $index => $paket): ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg card-hover">
                        <img src="<?php echo $paket['image']; ?>" alt="<?php echo $paket['judul']; ?>" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2"><?php echo $paket['judul']; ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo $paket['deskripsi']; ?></p>
                            
                            <div class="border-t pt-4 space-y-3">
                                <a href="https://www.youtube.com/watch?v=<?php echo $paket['video_id']; ?>" target="_blank" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                    Tonton Video Promosi
                                </a>
                                <button onclick="openModal()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                                    Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Modal Form Pemesanan -->
    <div id="modalPemesanan" class="modal">
        <div class="modal-content">
            <div class="bg-blue-600 text-white p-6 rounded-t-lg">
                <span class="close text-white" onclick="closeModal()">&times;</span>
                <h2 class="text-3xl font-bold">Form Pemesanan Paket Wisata</h2>
            </div>
            <div class="p-6">
                <form id="formPemesanan" action="proses_pesan.php" method="POST" onsubmit="return validateForm()">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Pemesan *</label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Masukkan nama lengkap">
                            <span class="text-red-500 text-sm hidden" id="error_nama">Nama pemesan harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor HP/Telp *</label>
                            <input type="text" name="nomor_hp" id="nomor_hp" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Contoh: 081234567890">
                            <span class="text-red-500 text-sm hidden" id="error_hp">Nomor HP harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal Pesan *</label>
                            <input type="date" name="tanggal_pesan" id="tanggal_pesan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <span class="text-red-500 text-sm hidden" id="error_tanggal">Tanggal pesan harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Waktu Pelaksanaan Perjalanan (Hari) *</label>
                            <input type="number" name="waktu_perjalanan" id="waktu_perjalanan" min="1" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Contoh: 2" oninput="hitungTotal()">
                            <span class="text-red-500 text-sm hidden" id="error_waktu">Waktu perjalanan harus diisi</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Pelayanan Paket Perjalanan *</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="pelayanan[]" value="1000000" class="mr-2 pelayanan-checkbox" onchange="hitungTotal()">
                                    <span>Penginapan (Rp 1.000.000)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="pelayanan[]" value="1200000" class="mr-2 pelayanan-checkbox" onchange="hitungTotal()">
                                    <span>Transportasi (Rp 1.200.000)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="pelayanan[]" value="500000" class="mr-2 pelayanan-checkbox" onchange="hitungTotal()">
                                    <span>Service/Makan (Rp 500.000)</span>
                                </label>
                            </div>
                            <span class="text-red-500 text-sm hidden" id="error_pelayanan">Pilih minimal satu pelayanan</span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Jumlah Peserta *</label>
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" min="1" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Contoh: 2" oninput="hitungTotal()">
                            <span class="text-red-500 text-sm hidden" id="error_peserta">Jumlah peserta harus diisi</span>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Harga Paket Perjalanan:</span>
                                <span id="harga_paket" class="font-bold text-blue-600">Rp 0</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">Jumlah Tagihan:</span>
                                <span id="jumlah_tagihan" class="font-bold text-green-600 text-xl">Rp 0</span>
                            </div>
                        </div>

                        <input type="hidden" name="harga_paket_hidden" id="harga_paket_hidden">
                        <input type="hidden" name="jumlah_tagihan_hidden" id="jumlah_tagihan_hidden">

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                                Simpan Pesanan
                            </button>
                            <button type="button" onclick="closeModal()" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-3 rounded-lg font-semibold transition">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Wisata Jatitujuh</h3>
                    <p class="text-gray-400">UMKM Pariwisata yang menyediakan paket wisata terbaik di Jatitujuh, Majalengka.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <p class="text-gray-400">📧 info@wisatajatitujuh.com</p>
                    <p class="text-gray-400">📞 +62 812-3456-7890</p>
                    <p class="text-gray-400">📍 Jatitujuh, Majalengka, Indonesia</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Menu</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#beranda" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#paket-wisata" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="modifikasi_pesanan.php" class="hover:text-white transition">Daftar Pesanan</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Wisata Jatitujuh UMKM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
        
        // Banner Carousel
        let currentBanner = 0;
        const banners = document.querySelectorAll('.banner-image');
        const dots = document.querySelectorAll('.banner-dot');
        
        function showBanner(index) {
            banners.forEach((banner, i) => {
                banner.style.opacity = i === index ? '1' : '0';
            });
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-opacity-50');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.add('bg-opacity-50');
                    dot.classList.remove('bg-white');
                }
            });
        }
        
        function nextBanner() {
            currentBanner = (currentBanner + 1) % banners.length;
            showBanner(currentBanner);
        }
        
        setInterval(nextBanner, 5000);
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentBanner = index;
                showBanner(currentBanner);
            });
        });

        // Modal Functions
        function openModal() {
            document.getElementById('modalPemesanan').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalPemesanan').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalPemesanan');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Hitung Total
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

        // Validasi Form
        function validateForm() {
            let isValid = true;

            // Reset error messages
            document.querySelectorAll('[id^="error_"]').forEach(el => {
                el.classList.add('hidden');
            });

            // Validasi Nama
            const nama = document.getElementById('nama_pemesan').value.trim();
            if (nama === '') {
                document.getElementById('error_nama').classList.remove('hidden');
                isValid = false;
            }

            // Validasi HP
            const hp = document.getElementById('nomor_hp').value.trim();
            if (hp === '') {
                document.getElementById('error_hp').classList.remove('hidden');
                isValid = false;
            }

            // Validasi Tanggal
            const tanggal = document.getElementById('tanggal_pesan').value;
            if (tanggal === '') {
                document.getElementById('error_tanggal').classList.remove('hidden');
                isValid = false;
            }

            // Validasi Waktu Perjalanan
            const waktu = document.getElementById('waktu_perjalanan').value;
            if (waktu === '' || waktu <= 0) {
                document.getElementById('error_waktu').classList.remove('hidden');
                isValid = false;
            }

            // Validasi Pelayanan
            const checkboxes = document.querySelectorAll('.pelayanan-checkbox:checked');
            if (checkboxes.length === 0) {
                document.getElementById('error_pelayanan').classList.remove('hidden');
                isValid = false;
            }

            // Validasi Jumlah Peserta
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

        // Set tanggal hari ini sebagai default
        document.getElementById('tanggal_pesan').valueAsDate = new Date();
    </script>
</body>
</html>