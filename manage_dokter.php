<?php
session_start();
include 'koneksi.php'; 

// Cek Login Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$edit_id = '';
$edit_nama = '';
$edit_spesialisasi = '';
$edit_foto = '';
$edit_deskripsi = '';

$form_title = 'Tambah Dokter Baru';
$form_action = 'manage_dokter.php';

// --- LOGIKA SIMPAN (INSERT / UPDATE) ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan_dokter'])) {
    $nama = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];
    $foto = $_POST['foto_dokter'];
    $deskripsi = $_POST['deskripsi'];
    $id = $_POST['id_dokter']; 

    try {
        if (empty($id)) {
            // INSERT DATA BARU
            $sql = "INSERT INTO tb_dokter (nama_dokter, spesialisasi, foto_dokter, deskripsi) VALUES (?, ?, ?, ?)";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param('ssss', $nama, $spesialisasi, $foto, $deskripsi);
            $stmt->execute();
        } else {
            // UPDATE DATA LAMA
            $sql = "UPDATE tb_dokter SET nama_dokter = ?, spesialisasi = ?, foto_dokter = ?, deskripsi = ? WHERE id_dokter = ?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param('ssssi', $nama, $spesialisasi, $foto, $deskripsi, $id);
            $stmt->execute();
        }
        $stmt->close();
        header('Location: manage_dokter.php'); 
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// --- LOGIKA HAPUS ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    try {
        $sql = "DELETE FROM tb_dokter WHERE id_dokter = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header('Location: manage_dokter.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// --- LOGIKA EDIT (AMBIL DATA) ---
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    try {
        $sql = "SELECT * FROM tb_dokter WHERE id_dokter = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $edit_id = $data['id_dokter'];
            $edit_nama = $data['nama_dokter'];
            $edit_spesialisasi = $data['spesialisasi'];
            $edit_foto = $data['foto_dokter'];
            $edit_deskripsi = $data['deskripsi'];
            
            $form_title = "Edit Dokter (ID: $edit_id)";
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
    <title>Manage Dokter</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f7fa; display: flex; }
        .sidebar { width: 250px; background-color: #343a40; color: white; min-height: 100vh; padding: 20px; }
        .sidebar h2 { text-align: center; color: #ffffff; margin-bottom: 30px; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { margin-bottom: 10px; }
        .sidebar ul li a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 15px; border-radius: 5px; transition: background 0.3s; }
        .sidebar ul li a:hover, .sidebar ul li a.active { background-color: #495057; color: white; }
        .main-content { flex-grow: 1; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 2.5rem; }
        .logout-btn { background-color: #dc3545; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .card { background-color: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .card-header { border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-danger { background-color: #dc3545; color: white; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .table th { background-color: #f8f9fa; font-weight: bold; }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="indexadmin.php">Dashboard</a></li>
            <li><a href="manage_dokter.php" class="active">Manage Dokter</a></li>
            <li><a href="manage_obat.php">Manage Obat</a></li>
            <li><a href="manage_berita.php">Manage Berita</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Manage Dokter</h1>
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
                <input type="hidden" name="id_dokter" value="<?php echo htmlspecialchars($edit_id); ?>">
                
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" id="nama_dokter" name="nama_dokter" class="form-control" 
                           value="<?php echo htmlspecialchars($edit_nama); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi</label>
                    <input type="text" id="spesialisasi" name="spesialisasi" class="form-control" 
                           value="<?php echo htmlspecialchars($edit_spesialisasi); ?>" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required><?php echo htmlspecialchars($edit_deskripsi); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="foto_dokter">URL Foto Dokter</label>
                    <input type="text" id="foto_dokter" name="foto_dokter" class="form-control" 
                           value="<?php echo htmlspecialchars($edit_foto); ?>" placeholder="Contoh: https://example.com/foto.jpg">
                </div>
                
                <div>
                    <button type="submit" name="simpan_dokter" class="btn btn-primary">Simpan</button>
                    <?php if (!empty($edit_id)): ?>
                        <a href="manage_dokter.php" class="btn btn-secondary">Batal Edit</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="card table-wrapper">
            <div class="card-header">
                <h2>Daftar Dokter</h2>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Deskripsi (Singkat)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = "SELECT * FROM tb_dokter ORDER BY id_dokter DESC";
                        $result = $koneksi->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $deskripsi_singkat = strlen($row['deskripsi']) > 50 ? substr($row['deskripsi'], 0, 50) . '...' : $row['deskripsi'];
                                
                                echo "<tr>";
                                echo "<td>" . $row['id_dokter'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_dokter']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['spesialisasi']) . "</td>";
                                echo "<td>" . htmlspecialchars($deskripsi_singkat) . "</td>";
                                echo "<td>";
                                echo "<a href='?edit=" . $row['id_dokter'] . "' class='btn btn-warning'>Edit</a> ";
                                echo "<a href='?hapus=" . $row['id_dokter'] . "' class='btn btn-danger' 
                                      onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data dokter.</td></tr>";
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