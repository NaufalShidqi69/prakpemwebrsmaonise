<?php 
// 1. Memanggil file header.php
// (File ini sudah otomatis memanggil koneksi.php dan memulai sesi)
include 'header.php'; 
?>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col text-center">
            <h1 class="display-4 fw-bold">Tim Dokter Kami</h1>
            <p class="lead text-muted">Temukan dokter spesialis terbaik yang siap melayani Anda.</p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php
        // 1. Buat SQL query untuk mengambil semua data dokter
        // Diurutkan berdasarkan Nama Dokter A-Z
        $sql = "SELECT * FROM tb_dokter ORDER BY nama_dokter ASC";
        
        // 2. Jalankan query (variabel $koneksi sudah ada dari header.php)
        $result = $koneksi->query($sql);

        // 3. Cek jika ada data yang ditemukan
        if ($result && $result->num_rows > 0) {
            
            // 4. Looping (ulangi) data selagi masih ada
            while ($row = $result->fetch_assoc()) {
        ?>

        <div class="col">
            <div class="card h-100 text-center shadow-sm border-0 news-card-new">
                
                <img src="<?php echo htmlspecialchars($row['foto_dokter']); ?>" 
                     class="card-img-top" 
                     alt="<?php echo htmlspecialchars($row['nama_dokter']); ?>" 
                     style="height: 300px; object-fit: cover; object-position: top;">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold">
                        <?php echo htmlspecialchars($row['nama_dokter']); ?>
                    </h5>
                    
                    <p class="text-primary fw-bold mb-3">
                        <?php echo htmlspecialchars($row['spesialisasi']); ?>
                    </p>
                    
                    <p class="card-text text-muted small">
                        <?php 
                        // Potong deskripsi jika terlalu panjang (lebih dari 100 karakter)
                        $deskripsi = htmlspecialchars($row['deskripsi']);
                        if (strlen($deskripsi) > 100) {
                            echo substr($deskripsi, 0, 100) . "...";
                        } else {
                            echo $deskripsi;
                        }
                        ?>
                    </p>
                    
                    <a href="login.php" class="btn btn-primary mt-auto">
                        Buat Janji Temu
                    </a>
                </div>
            </div>
        </div>
        <?php 
            } // Ini adalah penutup dari "while loop"
        } else {
            // Tampilkan ini jika tidak ada data dokter di tabel
            echo "<div class='col-12'><p class='text-center text-muted'>Belum ada data dokter untuk ditampilkan.</p></div>";
        }
        ?>

    </div> </div> <?php 
// 2. Memanggil file footer.php
include 'footer.php'; 
?>
