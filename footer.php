<!-- ====== FOOTER BARU (SESUAI GAMBAR) ====== -->
    <footer class="bg-primary text-white pt-5 pb-4"> <!-- Diubah dari bg-dark ke bg-primary agar cocok dengan header -->
        <div class="container">
            <!-- Baris untuk 5 kolom link -->
            <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-5">
                
                <!-- Kolom 1: Tentang Kami -->
                <div class="col">
                    <h6 class="fw-bold mb-3">Tentang Kami</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Overview</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">History</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Pencapaian</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Hubungan Investor</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Program CSR</a></li>
                    </ul>
                </div>

                <!-- Kolom 2: Untuk Pasien -->
                <div class="col">
                    <h6 class="fw-bold mb-3">Untuk Pasien</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="fasilitas.php" class="text-white text-decoration-none opacity-75 hover-opacity-100">Pusat Unggulan</a></li>
                        <li class="mb-2"><a href="konsul.php" class="text-white text-decoration-none opacity-75 hover-opacity-100">Telekonsultasi</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">FAQ</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Untuk Perusahaan -->
                <div class="col">
                    <h6 class="fw-bold mb-3">Untuk Perusahaan</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Laporan Keuangan</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Laporan Tahunan</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Corporate Governance</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Untuk Profesional -->
                <div class="col">
                    <h6 class="fw-bold mb-3">Untuk Profesional</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Pusat Pelatihan</a></li>
                        <li class="mb-2"><a href="dokter.php" class="text-white text-decoration-none opacity-75 hover-opacity-100">Pusat Unggulan</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Karir</a></li>
                    </ul>
                </div>

                <!-- Kolom 5: Ayo Terhubung -->
                <div class="col">
                    <h6 class="fw-bold mb-3">Ayo Terhubung dengan Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-4 hover-opacity-100 opacity-75"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="text-white fs-4 hover-opacity-100 opacity-75"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-4 hover-opacity-100 opacity-75"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-4 hover-opacity-100 opacity-75"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <!-- Garis Pemisah & Copyright -->
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);"> 

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center small">
                <p class="text-white-50 mb-3 mb-sm-0">© Copyright 2025, RS Maonise. All Rights Reserved.</p>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Syarat dan Ketentuan</a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
    </footer>

<?php
// INI BAGIAN BARU: Panggil file bot
// File bot.php sendiri yang akan memutuskan kapan harus tampil
include 'bot.php';
?>
    <!-- ====== END FOOTER ====== -->


    <!-- ======================================================== -->
    <!-- ==== URUTAN SCRIPT YANG BENAR (PENTING!) ==== -->
    <!-- =Failure to provide the `integrity` attribute for scripts or styles loaded from a CDN (like Bootstrap) poses a security risk, as it prevents the browser from verifying that the file hasn't been maliciously altered. This vulnerability, known as a Supply Chain Attack, could allow attackers to inject and execute arbitrary code within the context of the user's session, leading to potential data theft, session hijacking, or other malicious activities. It is crucial to always include the `integrity` attribute with the correct hash value when loading resources from third-party sources.================================================ -->

    <!-- 1. WAJIB Bootstrap JS (dari CDN) - 'xintegrity' SUDAH DIPERBAIKI -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- 2. BARU script.js kustom Anda (yang bergantung pada Bootstrap) -->
    <script src="js/script.js"></script>

</body>
</html>
