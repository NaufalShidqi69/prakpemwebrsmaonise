<?php 
// Pastikan output buffering aktif
ob_start();

include 'header.php'; 
?>

<style>
    /* Hero & General */
    .hero-container {
        height: 60vh;
        min-height: 450px;
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/1692693/pexels-photo-1692693.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
    }

    /* Kartu Berita Baru */
    .news-card-new {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        transition: border-color 0.3s ease;
    }
    .news-card-new:hover { border-color: #adb5bd; }
    .news-card-img-new { height: 180px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px; }
    .news-link-green { color: #198754; transition: opacity 0.2s; }
    .news-link-green:hover { color: #146c43; opacity: 0.8; }

    /* Badge Kategori */
    .news-badge-jantung { background-color: #fce8e6 !important; color: #c9372c !important; }
    .news-badge-gizi { background-color: #e6f7f0 !important; color: #0a6840 !important; }
    .news-badge-gayahidup { background-color: #e6f7ff !important; color: #0d6efd !important; }

    /* --- MODAL STYLE (PERCANTIK BAGIAN INI) --- */
    .custom-modal-content {
        border-radius: 1.5rem; /* Sudut lebih bulat */
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    /* Lingkaran Pembungkus Ikon */
    .modal-icon-wrapper {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        margin-bottom: 1.5rem;
    }

    .custom-modal-icon { font-size: 3.5rem; }

    /* Warna Tema Hasil */
    /* Rendah (Hijau) */
    .theme-low .modal-icon-wrapper { background-color: #e8f5e9; }
    .theme-low .custom-modal-icon { color: #2e7d32; }
    .theme-low .custom-modal-title { color: #2e7d32; }

    /* Menengah (Kuning/Orange - Sesuai Gambar) */
    .theme-medium .modal-icon-wrapper { background-color: #fff8e1; }
    .theme-medium .custom-modal-icon { color: #ffc107; }
    .theme-medium .custom-modal-title { color: #ffc107; }

    /* Tinggi (Merah) */
    .theme-high .modal-icon-wrapper { background-color: #ffebee; }
    .theme-high .custom-modal-icon { color: #c62828; }
    .theme-high .custom-modal-title { color: #c62828; }

    /* Teks Judul & Persen */
    .custom-modal-title {
        font-weight: 700;
        font-size: 1.8rem;
    }
    
    .custom-modal-percent {
        font-size: 4.5rem; /* Sangat Besar */
        font-weight: 800;
        line-height: 1;
        color: #343a40;
        margin: 10px 0;
    }

    .custom-modal-based-on {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .custom-modal-desc {
        font-size: 1.1rem;
        color: #495057;
        line-height: 1.6;
        padding: 0 10px;
    }

    .btn-outline-custom {
        border: 2px solid #0d6efd;
        color: #0d6efd;
        font-weight: 600;
        padding: 0.6rem 2rem;
        border-radius: 50px; /* Tombol bulat */
    }
    .btn-outline-custom:hover {
        background-color: #0d6efd;
        color: white;
    }
</style>

<div class="hero-container">
    <div class="container text-white d-flex flex-column justify-content-center h-100">
        <h1 class="display-3 fw-bold">Peduli, Profesional, dan Penuh Kasih</h1>
        <p class="lead col-lg-7">Temukan dokter, buat janji, dan akses layanan medis terbaik kami dengan mudah.</p>
    </div>
</div>

<section class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-5">
            <h2 class="display-5 fw-bold mb-3">Temukan Kami</h2>
            <p class="lead text-muted">Kunjungi kami untuk mendapatkan pelayanan kesehatan terbaik. Kami siap melayani Anda 24 jam.</p>
            <hr class="my-4">
            <div class="d-flex align-items-start mb-3">
                <i class="bi bi-geo-alt-fill fs-4 text-primary me-3"></i>
                <div>
                    <h5 class="fw-bold mb-0">Alamat</h5>
                    <p class="text-muted mb-0">Jl. Maonise Raya No. 66, Batavia, Indonesia 69696</p>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <i class="bi bi-telephone-fill fs-4 text-primary me-3"></i>
                <div>
                    <h5 class="fw-bold mb-0">Telepon UGD</h5>
                    <p class="text-muted mb-0">(021) 666-666 (24 Jam)</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <iframe src="https://maps.google.com/maps?q=Siloam%20Hospitals%20Yogyakarta&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<div class="container px-4 py-5" id="layanan-unggulan">
    <h2 class="pb-2 border-bottom text-center fw-bold display-5">Layanan Unggulan Kami</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-md-3">
        <div class="feature col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-1 mb-3 rounded-3 p-3"><i class="bi bi-hospital"></i></div>
            <h3 class="fs-2 text-body-emphasis">Fasilitas & Kamar</h3>
            <p>Lihat berbagai tipe kamar rawat inap kami, dari VIP hingga Kelas 2.</p>
            <a href="fasilitas.php" class="icon-link d-inline-flex align-items-center text-decoration-none fw-bold">Lihat Selengkapnya <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
        <div class="feature col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-1 mb-3 rounded-3 p-3"><i class="bi bi-person-circle"></i></div>
            <h3 class="fs-2 text-body-emphasis">Dokter & Konsultasi</h3>
            <p>Temukan dokter spesialis kami, cek jadwal praktik, atau konsultasi online.</p>
            <a href="dokter.php" class="icon-link d-inline-flex align-items-center text-decoration-none fw-bold">Lihat Selengkapnya <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
        <div class="feature col text-center">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-1 mb-3 rounded-3 p-3"><i class="bi bi-capsule"></i></div>
            <h3 class="fs-2 text-body-emphasis">Informasi Obat</h3>
            <p>Akses pusat informasi obat kami untuk membaca penjelasan dan dosis.</p>
            <a href="apotek.php" class="icon-link d-inline-flex align-items-center text-decoration-none fw-bold">Lihat Selengkapnya <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>

<div class="news-section py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h2 class="display-5 fw-bold mb-3">Berita & Healthpedia</h2>
                <p class="lead text-muted mb-4">Temukan informasi kesehatan yang bermanfaat.</p>
                <a href="#" class="text-decoration-none fw-bold news-link-green">Lihat Semua Artikel <i class="bi bi-arrow-right ms-1"></i></a>
                <hr class="my-4">
                <div class="d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Alergi</a>
                    <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Diet Sehat</a>
                    <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Covid</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="news-category-scroll-wrapper mb-4">
                    <a href="#" class="btn btn-success rounded-pill news-category-pill active">Semua Artikel</a>
                    <a href="#" class="btn btn-light rounded-pill news-category-pill">Kesehatan Tubuh</a>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    if (isset($koneksi)) {
                        $sql = "SELECT * FROM tb_berita ORDER BY id DESC LIMIT 2";
                        $result = $koneksi->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $kategori = strtolower($row['kategori']);
                                $badge_class = ($kategori == 'jantung') ? 'news-badge-jantung' : (($kategori == 'gizi') ? 'news-badge-gizi' : 'news-badge-gayahidup');
                    ?>
                            <div class="col">
                                <div class="card h-100 news-card-new">
                                    <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" class="card-img-top news-card-img-new" alt="Artikel">
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2"><span class="badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['kategori']); ?></span></div>
                                        <h5 class="card-title news-card-title-new"><?php echo htmlspecialchars($row['judul']); ?></h5>
                                        <a href="<?php echo htmlspecialchars($row['link_artikel']); ?>" target="_blank" class="text-decoration-none fw-bold mt-auto news-link-green">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                    <?php 
                            } 
                        } else { echo "<div class='col-12'><p class='text-center text-muted'>Belum ada berita.</p></div>"; }
                    } else { echo "<div class='col-12'><p class='text-center text-danger'>Koneksi database error.</p></div>"; }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="calculator-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <span class="text-primary fw-bold text-uppercase">Kalkulator Kesehatan</span>
                <h1 class="display-4 fw-bold mt-2 mb-3">Hitung Risiko Jantung</h1>
                <p class="lead text-muted">Cek risiko jantung Anda dengan mengisi formulir untuk mengetahui nilai risiko jantung.<br><small class="opacity-75">(Estimasi awal, bukan pengganti diagnosa medis)</small></p>
            </div>
            <div class="col-lg-7">
                <div class="calculator-form-card">
                    <form id="riskForm">
                        <div class="row g-4">
                            <div class="col-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="gender" id="genderMale" value="male" autocomplete="off">
                                    <label class="btn btn-toggle" for="genderMale">Laki-laki</label>
                                    <input type="radio" class="btn-check" name="gender" id="genderFemale" value="female" autocomplete="off">
                                    <label class="btn btn-toggle" for="genderFemale">Perempuan</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Merokok?</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="smoker" id="smokerYes" value="yes" autocomplete="off">
                                    <label class="btn btn-toggle" for="smokerYes">Ya</label>
                                    <input type="radio" class="btn-check" name="smoker" id="smokerNo" value="no" autocomplete="off">
                                    <label class="btn btn-toggle" for="smokerNo">Tidak</label>
                                </div>
                            </div>
                            <div class="col-6"><label class="form-label">Berat (kg)</label><input type="number" class="form-control" id="weight" required></div>
                            <div class="col-6"><label class="form-label">Tinggi (cm)</label><input type="number" class="form-control" id="height" required></div>
                            <div class="col-6">
                                <label class="form-label">Umur</label>
                                <select class="form-select" id="age" required>
                                    <option value="" selected disabled>Pilih Umur</option>
                                    <option value="20-39">20 - 39 tahun</option>
                                    <option value="40-59">40 - 59 tahun</option>
                                    <option value="60+">60+ tahun</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tekanan Darah</label>
                                <select class="form-select" id="bp" required>
                                    <option value="" selected disabled>Pilih Angka</option>
                                    <option value="normal">Normal (<120/80 mmHg)</option>
                                    <option value="elevated">Meningkat (120-139 / 80-89)</option>
                                    <option value="high">Tinggi (≥140/90 mmHg)</option>
                                </select>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-submit w-100">Lanjut</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center custom-modal-content" id="modalContentTheme">
            
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body px-4 pb-4">
                <div class="modal-icon-wrapper shadow-sm">
                    <i id="modalIcon" class="bi custom-modal-icon"></i>
                </div>

                <p class="text-muted mb-0 custom-modal-text-label">Risiko Jantung Anda</p>
                
                <h1 class="custom-modal-title mb-0" id="modalTitle"></h1>
                
                <h3 class="custom-modal-percent" id="modalPercent"></h3>
                
                <p class="custom-modal-based-on">berdasarkan data yang dimasukkan.</p>
                
                <p class="custom-modal-desc" id="modalDescription"></p>
                
                <p class="small text-muted mt-4 pt-3 border-top">
                    Referensi: WHO Cardiovascular Disease Risk Chart South East Asia.
                </p>
            </div>
            
            <div class="modal-footer justify-content-center border-0 pb-5 pt-0">
                <button type="button" class="btn btn-outline-custom w-75" data-bs-dismiss="modal">
                    Hitung Ulang
                </button>
            </div>

        </div>
    </div>
</div>

<?php 
include 'footer.php'; 
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("Sistem Kalkulator Siap!");

    const riskForm = document.getElementById('riskForm');
    const resultModalElement = document.getElementById('resultModal');
    const modalContent = document.getElementById('modalContentTheme');

    if (!riskForm || !resultModalElement) return;

    let resultModal;
    try {
        resultModal = new bootstrap.Modal(resultModalElement);
    } catch (e) { console.error("Bootstrap error"); return; }

    riskForm.addEventListener('submit', function(event) {
        
        // TAHAN REFRESH
        event.preventDefault(); 
        
        // Ambil Data
        const gender = document.querySelector('input[name="gender"]:checked');
        const smoker = document.querySelector('input[name="smoker"]:checked');
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);
        const age = document.getElementById('age').value;
        const bp = document.getElementById('bp').value;

        if (!gender || !smoker || !weight || !height || !age || !bp) {
            alert('Harap isi semua data terlebih dahulu.');
            return;
        }

        // Logika Hitung Sederhana
        let riskScore = 0;
        if (age === '40-59') riskScore += 10;
        if (age === '60+') riskScore += 20;
        if (smoker.value === 'yes') riskScore += 20;
        if (bp === 'elevated') riskScore += 10;
        if (bp === 'high') riskScore += 25;

        const bmi = weight / ((height/100) * (height/100));
        if (bmi >= 25 && bmi < 30) riskScore += 10;
        if (bmi >= 30) riskScore += 20;

        // Tentukan Hasil (Teks, Ikon, Tema Warna)
        let title, description, percent, iconClass, themeClass;

        // Reset class tema sebelumnya
        modalContent.classList.remove('theme-low', 'theme-medium', 'theme-high');

        if (riskScore < 20) {
            // RISIKO RENDAH (Hijau - Shield)
            title = "Risiko Rendah";
            percent = riskScore + "%";
            description = "Risiko jantung Anda <b>Rendah</b>. Jaga terus pola hidup sehat Anda!";
            iconClass = "bi-shield-fill-check";
            themeClass = "theme-low";
        } else if (riskScore < 45) {
            // RISIKO MENENGAH (Kuning - Segitiga Seru seperti gambar)
            title = "Risiko Menengah";
            percent = riskScore + "%";
            description = "Risiko jantung Anda <b>Menengah</b>. Mulailah berolahraga dan perbaiki pola makan.";
            iconClass = "bi-exclamation-triangle-fill";
            themeClass = "theme-medium";
        } else {
            // RISIKO TINGGI (Merah - Hati)
            title = "Risiko Tinggi";
            percent = riskScore + "%";
            description = "Risiko jantung Anda <b>Tinggi</b>. Segera konsultasikan dengan dokter.";
            iconClass = "bi-heartbreak-fill";
            themeClass = "theme-high";
        }

        // Masukkan Data ke HTML Modal
        modalContent.classList.add(themeClass); // Tambah class tema warna
        document.getElementById('modalIcon').className = "bi custom-modal-icon " + iconClass;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalPercent').textContent = percent;
        document.getElementById('modalDescription').innerHTML = description;

        // Munculkan Modal
        resultModal.show();
    });
});
</script>

</body>
</html>
<?php
ob_end_flush(); 
?>
