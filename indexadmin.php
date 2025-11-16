<?php
session_start();

// 1. PERBAIKAN: Cek session 'role' yang diatur oleh login.php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php'; // Pastikan ini 'koneksi.php' (sesuai file login)

// Ganti nama koneksi ke '$koneksi' agar konsisten
$total_dokter = 0;
$total_obat = 0;
$total_berita = 0;
$total_users = 0;

$result_dokter = $koneksi->query("SELECT COUNT(*) as total FROM tb_dokter");
if ($result_dokter) {
    $total_dokter = $result_dokter->fetch_assoc()['total'];
}

$result_obat = $koneksi->query("SELECT COUNT(*) as total FROM tb_apotek");
if ($result_obat) {
    $total_obat = $result_obat->fetch_assoc()['total'];
}

$result_berita = $koneksi->query("SELECT COUNT(*) as total FROM tb_berita");
if ($result_berita) {
    $total_berita = $result_berita->fetch_assoc()['total'];
}

$result_users = $koneksi->query("SELECT COUNT(*) as total FROM users");
if ($result_users) {
    $total_users = $result_users->fetch_assoc()['total'];
}

$koneksi->close();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f7f6;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            text-align: center;
            color: #ecf0f1;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 18px;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar ul li a.active,
        .sidebar ul li a:hover {
            background-color: #3498db;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header .logout-btn {
            text-decoration: none;
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .header .logout-btn:hover {
            background-color: #c0392b;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 20px;
        }
        .stat-box {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-box h2 {
            margin: 0;
            font-size: 36px;
            color: #3498db;
        }
        .stat-box p {
            margin: 5px 0 0 0;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="indexadmin.php" class="active">Dashboard</a></li>
            <li><a href="manage_dokter.php">Manage Dokter</a></li>
            <li><a href="manage_obat.php">Manage Obat</a></li>
            <li><a href="manage_berita.php">Manage Berita</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Dashboard</h1>
                <?php if(isset($_SESSION['nama_user'])): ?>
                    <h3>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama_user']); ?>!</h3>
                <?php endif; ?>
            </div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="dashboard-stats">
            <div class="stat-box">
                <h2><?php echo $total_dokter; ?></h2>
                <p>Total Dokter</p>
            </div>
            <div class="stat-box">
                <h2><?php echo $total_obat; ?></h2>
                <p>Total Obat</p>
            </div>
            <div class="stat-box">
                <h2><?php echo $total_berita; ?></h2>
                <p>Total Berita</p>
            </div>
            <div class="stat-box">
                <h2><?php echo $total_users; ?></h2>
                <p>Total Users</p>
            </div>
        </div>
    </div>

</body>
</html>
