<?php 
include 'header.php'; 
?>

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
            <p class="lead text-muted">
                Kunjungi kami untuk mendapatkan pelayanan kesehatan terbaik. Kami siap melayani Anda 24 jam.
            </p>
            
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
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.060350196185!2d110.38830327500501!3d-7.78342639223634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59c55cef4c69%3A0xc020b62112edd35e!2sSiloam%20Hospitals%20Yogyakarta!5e0!3m2!1sid!2sid!4v1761894993266!5m2!1sid!2sid" 
    width="100%" 
    height="450" 
    style="border:0;" 
    allowfullscreen="" l
    oading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
            </div>
        </div>

    </div>
</section>

    <div class="container px-4 py-5" id="layanan-unggulan">
    
        <h2 class="pb-2 border-bottom text-center fw-bold display-5">Layanan Unggulan Kami</h2>

        <div class="row g-4 py-5 row-cols-1 row-cols-md-3">

            <div class="feature col text-center">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-1 mb-3 rounded-3 p-3">
                    <i class="bi bi-hospital"></i>
                </div>
                <h3 class="fs-2 text-body-emphasis">Fasilitas & Kamar</h3>
                <p>Lihat berbagai tipe kamar rawat inap kami, dari VIP hingga Kelas 2, serta fasilitas medis penunjang lainnya.</p>
                
                <a href="fasilitas.php" class="icon-link d-inline-flex align-items-center text-decoration-none fw-bold">
                    Lihat Selengkapnya
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="feature col text-center">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-1 mb-3 rounded-3 p-3">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h3 class="fs-2 text-body-emphasis">Dokter & Konsultasi</h3>
                <p>Temukan dokter spesialis kami, cek jadwal praktik, atau mulai sesi konsultasi online langsung dari rumah Anda.</p>
                
                <a href="dokter.php" class="icon-link d-inline-flex align-items-center text-decoration-none fw-bold">
                    Lihat Selengkapnya
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="feature col text-center">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-1 mb-3 rounded-3 p-3">
                    <i class="bi bi-capsule"></i>
                </div>
                <h3 class="fs-2 text-body-emphasis">Informasi Obat</h3>
                <p>Akses pusat informasi obat kami untuk membaca penjelasan, dosis, dan efek samping dari obat-obatan.</p>
                
                <a href="apotek.php" class="icon-link d-inline-flex align-items-center text-decoration-none fw-bold">
                    Lihat Selengkapnya
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="news-section py-5">
        <div class="container">
            <div class="row g-5">
                
                <div class="col-lg-4">
                    <h2 class="display-5 fw-bold mb-3">Berita & Healthpedia</h2>
                    <p class="lead text-muted mb-4">Temukan informasi kesehatan yang bermanfaat untuk hidup lebih sehat.</p>
                    <a href="#" class="text-decoration-none fw-bold news-link-green">
                        Lihat Semua Artikel
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <hr class="my-4">
                    <p class="text-muted fw-bold mb-3">Atau Telusuri Topik Populer</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Alergi</a>
                        <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Gangguan Kecemasan</a>
                        <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Diet Sehat</a>
                        <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Anak</a>
                        <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Wajah</a>
                        <a href="#" class="btn btn-outline-secondary rounded-pill news-topic-pill">Covid</a>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="news-category-scroll-wrapper mb-4">
                        <a href="#" class="btn btn-success rounded-pill news-category-pill active">Semua Artikel</a>
                        <a href="#" class="btn btn-light rounded-pill news-category-pill">Kesehatan Tubuh</a>
                        <a href="#" class="btn btn-light rounded-pill news-category-pill">Kecantikan</a>
                        <a href="#" class="btn btn-light rounded-pill news-category-pill">Ibu dan Anak</a>
                        <a href="#" class="btn btn-light rounded-pill news-category-pill">Pola Hidup Sehat</a>
                        <a href="#" class="btn btn-light rounded-pill news-category-pill">Kesehatan Mental</a>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php
                        $sql = "SELECT * FROM tb_berita ORDER BY id DESC LIMIT 2";
                        
                        $result = $koneksi->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        
                        <div class="col">
                            <div class="card h-100 news-card-new">
                                <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" class="card-img-top news-card-img-new" alt="Ilustrasi artikel">
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <?php 
                                            $kategori = strtolower($row['kategori']);
                                            $badge_class = 'news-badge-gayahidup'; 
                                            if ($kategori == 'jantung') {
                                                $badge_class = 'news-badge-jantung';
                                            } else if ($kategori == 'gizi') {
                                                $badge_class = 'news-badge-gizi';
                                            }
                                        ?>
                                        <span class="badge <?php echo $badge_class; ?>">
                                            <?php echo htmlspecialchars($row['kategori']); ?>
                                        </span>
                                    </div>
                                    <h5 class="card-title news-card-title-new"><?php echo htmlspecialchars($row['judul']); ?></h5>
                                    
                                    <a href="<?php echo htmlspecialchars($row['link_artikel']); ?>" target="_blank"
                                        class="text-decoration-none fw-bold mt-auto news-link-green">
                                        Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php 
                            } 
                        } else {
                            echo "<p class='text-center text-muted'>Belum ada berita untuk ditampilkan.</p>";
                        }
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
                    <p class="lead text-muted">Cek risiko jantung Anda dengan mengisi formulir untuk mengetahui
                        nilai risiko jantung.
                        <br><small class="opacity-75">(Kalkulator ini hanya untuk estimasi...)</small>
                    </p>
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
                                    <label class="form-label">Apakah kamu merokok?</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="smoker" id="smokerYes" value="yes" autocomplete="off">
                                        <label class="btn btn-toggle" for="smokerYes">Ya</label>
                                        <input type="radio" class="btn-check" name="smoker" id="smokerNo" value="no" autocomplete="off">
                                        <label class="btn btn-toggle" for="smokerNo">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="weight" class="form-label">Berat Badan</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="weight" placeholder="Berat" required>
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="height" class="form-label">Tinggi Badan</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="height" placeholder="Tinggi" required>
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="age" class="form-label">Umur</label>
                                    <select class="form-select" id="age" required>
                                        <option value="" selected disabled>Masukan Umur Anda</option>
                                        <option value="20-39">20 - 39 tahun</option>
                                        <option value="40-59">40 - 59 tahun</option>
                                        <option value="60+">60+ tahun</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="bp" class="form-label">Tekanan Darah</label>
                                    <select class="form-select" id="bp" required>
                                        <option value="" selected disabled>Pilih Angka</option>
                                        <option value="normal">Normal (&lt;120/80 mmHg)</option>
                                        <option value="elevated">Meningkat (120-139 / 80-89 mmHg)</option>
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
            <div class="modal-content text-center custom-modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="modal-icon-wrapper mx-auto mb-3">
                        <i id="modalIcon" class="bi custom-modal-icon"></i>
                    </div>
                    <p class="text-muted mb-0 custom-modal-text-label">Risiko Jantung Anda</p>
                    <h1 class="custom-modal-title mb-2" id="modalTitle"></h1>
                    <h3 class="custom-modal-percent" id="modalPercent"></h3>
                    <p class="mb-4 custom-modal-based-on-data">berdasarkan data yang dimasukkan.</p>
                    <p class="custom-modal-description" id="modalDescription"></p>
                    <p class="small text-muted mt-3">
                        Referensi: WHO Cardiovascular Disease Risk Chart South East Asia.
                    </p>
                </div>
                <div class="modal-footer justify-content-center border-0 pb-4 flex-column">
                    <button type="button" class="btn btn-primary w-75 custom-modal-btn-primary mb-2" data-bs-dismiss="modal">
                        Cari Rekomendasi Paket
                    </button>
                    <button type="button" class="btn btn-outline-primary w-75 custom-modal-btn-secondary" data-bs-dismiss="modal">
                        Hitung Ulang
                    </button>
                </div>
            </div>
        </div>
    </div>


<?php 
include 'footer.php'; 

ob_end_flush(); 
?>
