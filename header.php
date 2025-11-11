<?php
ob_start(); 

include 'koneksi.php'; 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rumah Sakit Maonise</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <div class="marquee-container bg-primary text-white py-1">
        <div class="marquee-content">
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-telephone-fill me-2"></i> UGD 24 Jam: (021) 666-666
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-geo-alt-fill me-2"></i> Jl. Maonise Raya No. 66, Batavia, Indonesia 69696
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-clock-fill me-2"></i> Rumah Sakit Buka 24 Jam Penuh
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-newspaper me-2"></i> Berita Terbaru: 5 Cara Sederhana Menjaga Kesehatan Jantung
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-telephone-fill me-2"></i> UGD 24 Jam: (021) 666-666
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-geo-alt-fill me-2"></i> Jl. Maonise Raya No. 66, Batavia, Indonesia 69696
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-clock-fill me-2"></i> Rumah Sakit Buka 24 Jam Penuh
            </span>
            <span class="divider">•</span>
            <span class="d-inline-flex align-items-center">
                <i class="bi bi-newspaper me-2"></i> Berita Terbaru: Kualitas vs Kuantitas Tidur: Mana yang Lebih Penting?
            </span>
        </div>
    </div>

    <header class="py-2 bg-white shadow-sm sticky-top">
        <div class="container-fluid d-flex flex-wrap align-items-center px-4">

            <a href="index.php" class="d-flex align-items-center mb-2 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="img/maonis.png" alt="Logo RS Maonis" class="me-3"
                    style="height: 80px; width: auto; object-fit: contain;">
                <span class="font-rumahsakit">RS Maonise</span>
            </a>

            <?php
            $currentPage = basename($_SERVER['PHP_SELF']); //agar activenya bisa sesuai sama yang dibuka
            ?>

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" 
                       <?php echo ($currentPage == 'index.php') ? 'aria-current="page"' : ''; ?>>
                       Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="fasilitas.php" class="nav-link <?php echo ($currentPage == 'fasilitas.php') ? 'active' : ''; ?>"
                       <?php echo ($currentPage == 'fasilitas.php') ? 'aria-current="page"' : ''; ?>>
                       Fasilitas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dokter.php" class="nav-link <?php echo ($currentPage == 'dokter.php') ? 'active' : ''; ?>"
                       <?php echo ($currentPage == 'dokter.php') ? 'aria-current="page"' : ''; ?>>
                       Cari Dokter
                    </a>
                </li>
                <li class="nav-item">
                    <a href="konsul.php" class="nav-link <?php echo ($currentPage == 'konsul.php') ? 'active' : ''; ?>"
                       <?php echo ($currentPage == 'konsul.php') ? 'aria-current="page"' : ''; ?>>
                       Konsultasi Online
                    </a>
                </li>
                <li class="nav-item">
                    <a href="apotek.php" class="nav-link <?php echo ($currentPage == 'apotek.php') ? 'active' : ''; ?>"
                       <?php echo ($currentPage == 'apotek.php') ? 'aria-current="page"' : ''; ?>>
                       Apotek
                    </a>
                </li>
            </ul>
            <a href="login.php" class="btn btn-primary ms-4 px-3">
                <i class="bi bi-box-arrow-in-right me-1"></i>
                Login
            </a>

        </div>
    </header>