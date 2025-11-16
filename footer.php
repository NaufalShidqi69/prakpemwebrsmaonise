<?php
// 1. Memanggil file header.php (CSS, Menu, Koneksi, dll sudah ada di sini)
include 'header.php';
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4 fw-bold">Fasilitas & Ruang Rawat Inap</h1>
            <p class="lead text-muted">Kami menyediakan fasilitas terbaik untuk kenyamanan dan kesembuhan Anda.</p>
        </div>
    </div>

    <h2 class="pb-2 border-bottom mb-4">Ruang Rawat Inap</h2>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <div class="col">
            <div class="card h-100 shadow-sm border-0 news-card-new">
                <img src="https://rumahsakitislam.com/images/2023/07/07/vip-anyarrr-1.jpg" class="card-img-top news-card-img-new" alt="Kamar VIP">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Kamar VIP / VVIP</h5>
                    <p class="card-text text-muted small">Kenyamanan dan privasi eksklusif dengan pelayanan penuh.</p>
                    <ul class="list-unstyled text-muted small mt-3">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>1 Tempat Tidur Pasien</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Sofa & Meja Tamu</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>TV Kabel 42 inch</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Kulkas & Microwave</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Kamar Mandi Dalam (Air Panas)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-0 news-card-new">
                <img src="https://rskasihibu.com/wp-content/uploads/2025/02/DSC04926c-654x436.jpg" class="card-img-top news-card-img-new" alt="Kamar Kelas 1">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Kamar Kelas 1</h5>
                    <p class="card-text text-muted small">Solusi ideal untuk kenyamanan dengan fasilitas lengkap.</p>
                    <ul class="list-unstyled text-muted small mt-3">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>2 Tempat Tidur Pasien</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Kursi Tamu</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>TV Kabel 32 inch</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Kamar Mandi Dalam</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-0 news-card-new">
                <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?auto=format&fit=crop&w=800&q=80" class="card-img-top news-card-img-new" alt="Kamar Kelas 2">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Kamar Kelas 2 & 3</h5>
                    <p class="card-text text-muted small">Perawatan berkualitas dengan biaya yang terjangkau.</p>
                    <ul class="list-unstyled text-muted small mt-3">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>3-4 Tempat Tidur Pasien</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Nakas di setiap tempat tidur</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Kamar Mandi Bersama</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <h2 class="pb-2 border-bottom my-5">Fasilitas Penunjang Medis & Umum</h2>
    
    <div class="row g-4 py-3 row-cols-1 row-cols-md-2 row-cols-lg-3">

        <div class="col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-3 p-3">
                <i class="bi bi-heart-pulse"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Unit Gawat Darurat (UGD)</h4>
                <p class="text-muted small">Siap 24 jam dengan tim medis profesional dan peralatan lengkap.</p>
            </div>
        </div>

        <div class="col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-3 p-3">
                <i class="bi bi-eyedropper"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Laboratorium</h4>
                <p class="text-muted small">Pemeriksaan patologi, mikrobiologi, dan tes darah yang akurat.</p>
            </div>
        </div>

        <div class="col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-3 p-3">
                <i class="bi bi-person-bounding-box"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Radiologi & Pencitraan</h4>
                <p class="text-muted small">Didukung teknologi X-Ray, CT-Scan, dan MRI terbaru.</p>
            </div>
        </div>

        <div class="col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-3 p-3">
                <i class="bi bi-capsule-pill"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Farmasi / Apotek</h4>
                <p class="text-muted small">Menyediakan obat-obatan lengkap dan resep 24 jam.</p>
            </div>
        </div>

        <div class="col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-3 p-3">
                <i class="bi bi-cup-straw"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Kantin & Kafetaria</h4>
                <p class="text-muted small">Menyediakan makanan sehat dan higienis untuk pasien dan keluarga.</p>
            </div>
        </div>

        <div class="col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 rounded-3 p-3">
                <i class="bi bi-p-circle-fill"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Area Parkir Luas</h4>
                <p class="text-muted small">Area parkir yang aman dan memadai untuk kenyamanan pengunjung.</p>
            </div>
        </div>

    </div> </div> <?php
// 2. Memanggil file footer.php (Script JS, penutup </body>, </html> ada di sini)
include 'footer.php';
?>
