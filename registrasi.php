<?php
session_start();
include 'koneksi.php';

define('SECRET_ADMIN_CODE', 'ADMIN_RAHASIA_123');

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    $kode_admin = $_POST['kode_admin'];

    if (empty($nama_lengkap) || empty($email) || empty($password) || empty($konfirmasi_password)) {
        $error_message = "Semua bidang (kecuali Kode Admin) wajib diisi.";
    } 
    elseif ($password !== $konfirmasi_password) {
        $error_message = "Password dan Konfirmasi Password tidak cocok.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid.";
    } 
    else {
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $error_message = "Email ini sudah terdaftar. Silakan gunakan email lain.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $role = 'pengguna';
            
            if (!empty($kode_admin) && $kode_admin === SECRET_ADMIN_CODE) {
                $role = 'admin';
            }

            $stmt_insert = $conn->prepare("INSERT INTO users (nama_lengkap, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt_insert->bind_param("ssss", $nama_lengkap, $email, $password_hash, $role);

            if ($stmt_insert->execute()) {
                $_SESSION['register_success'] = "Registrasi berhasil! Akun Anda sebagai '$role' telah dibuat. Silakan login.";
                header("Location: login.php");
                exit;
            } else {
                $error_message = "Registrasi gagal. Terjadi kesalahan pada server.";
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .register-card {
            width: 100%;
            max-width: 450px;
            padding: 30px;
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <div class="register-card">
        <h2 class="text-center mb-4">Buat Akun Baru</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="registrasi.php" method="POST">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <hr class="my-4">
            <div class="mb-3">
                <label for="kode_admin" class="form-label">Kode Admin (Opsional)</label>
                <input type="text" class="form-control" id="kode_admin" name="kode_admin" placeholder="Kosongkan jika Anda pengguna biasa">
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
    </div>

</body>
</html>
