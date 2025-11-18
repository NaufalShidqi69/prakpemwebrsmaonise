<?php
session_start();
include 'koneksi.php'; 

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$edit_id = '';
$edit_nama = '';
$edit_deskripsi = '';
$edit_gambar = '';
$form_title = 'Tambah Obat Baru';
$form_action = 'manage_obat.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan_obat'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $gambar_url = $_POST['gambar_url'];
    $id = $_POST['id']; 

    try {
        if (empty($id)) {
            $sql = "INSERT INTO tb_apotek (nama, deskripsi, gambar_url) VALUES (?, ?, ?)";
            $stmt = $koneksi->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Prepare failed: " . $koneksi->error);
            }
            $stmt->bind_param('sss', $nama, $deskripsi, $gambar_url);
            $stmt->execute();
            
        } else {
            $sql = "UPDATE tb_apotek SET nama = ?, deskripsi = ?, gambar_url = ? WHERE id = ?";
            $stmt = $koneksi->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Prepare failed: " . $koneksi->error);
            }
            $stmt->bind_param('sssi', $nama, $deskripsi, $gambar_url, $id);
            $stmt->execute();
        }
        $stmt->close();
        header('Location: manage_obat.php'); 
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    try {
        $sql = "DELETE FROM tb_apotek WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $koneksi->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header('Location: manage_obat.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    try {
        $sql = "SELECT id, nama, deskripsi, gambar_url FROM tb_apotek WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $koneksi->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $edit_id = $data['id'];
            $edit_nama = $data['nama'];
            $edit_deskripsi = $data['deskripsi'];
            $edit_gambar = $data['gambar_url'];
            
            $form_title = "Edit Obat (ID: $edit_id)";
        }
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Obat</title>
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
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .card-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .card-header h2 {
            margin: 0;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; 
        }
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .table-wrapper {
            margin-top: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .table td .btn {
            padding: 5px 10px;
            font-size: 0.9rem;
            margin-right: 5px;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="indexadmin.php">Dashboard</a></li>
            <li><a href="manage_dokter.php">Manage Dokter</a></li>
            <li><a href="manage_obat.php" class="active">Manage Obat</a></li>
            <li><a href="manage_berita.php">Manage Berita</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Manage Obat</h1>
                <?php if(isset($_SESSION['nama_user'])): ?>
                    <h3>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama_user']); ?>!</h3>
                <?php endif; ?>
            </div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2><?php echo $form_title; ?></h2>
            </div>
            <form action="<?php echo $form_action; ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_id); ?>">
                
                <div class="form-group">
                    <label for="nama">Nama Obat</label>
                    <input type="text" id="nama" name="nama" class="form-control" 
                           value="<?php echo htmlspecialchars($edit_nama); ?>" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required><?php echo htmlspecialchars($edit_deskripsi); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="gambar_url">URL Gambar</label>
                    <input type="text" id="gambar_url" name="gambar_url" class="form-control" 
                           value="<?php echo htmlspecialchars($edit_gambar); ?>" placeholder="Contoh: https://example.com/gambar.jpg">
                </div>
                <div>
                    <button type="submit" name="simpan_obat" class="btn btn-primary">Simpan</button>
                    <?php if (!empty($edit_id)): ?>
                        <a href="manage_obat.php" class="btn btn-secondary">Batal Edit</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="card table-wrapper">
            <div class="card-header">
                <h2>Daftar Obat</h2>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Obat</th>
                        <th>Deskripsi (Singkat)</th>
                        <th>Gambar (URL)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = "SELECT id, nama, deskripsi, gambar_url FROM tb_apotek ORDER BY id DESC";
                        $result = $koneksi->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $deskripsi_singkat = strlen($row['deskripsi']) > 100 ? substr($row['deskripsi'], 0, 100) . '...' : $row['deskripsi'];
                                
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "<td>" . htmlspecialchars($deskripsi_singkat) . "</td>";
                                echo "<td>" . htmlspecialchars($row['gambar_url']) . "</td>";
                                echo "<td>";
                                echo "<a href='?edit=" . $row['id'] . "' class='btn btn-warning'>Edit</a> ";
                                echo "<a href='?hapus=" . $row['id'] . "' class='btn btn-danger' 
                                      onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data obat.</td></tr>";
                        }
                    } catch (Exception $e) {
                        echo "<tr><td colspan='5' style='text-align:center;'>Error: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
<?php
$koneksi->close(); 
?>