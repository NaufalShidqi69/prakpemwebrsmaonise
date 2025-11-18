<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php'; 

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f7fa;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #495057;
            color: white;
        }
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        .header h3 {
            margin: 0;
            font-weight: normal;
            font-size: 1.2rem;
            color: #555;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        
        /* CSS KHUSUS DASHBOARD */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .stat-box {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            text-align: center;
        }
        .stat-box h2 {
            margin: 0 0 10px 0;
            font-size: 3rem;
            color: #007bff;
        }
        .stat-box p {
            margin: 0;
            font-size: 1.1rem;
            color: #555;
            font-weight: bold;
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
