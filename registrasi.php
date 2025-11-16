<?php
// Mulai session untuk menyimpan pesan
session_start();
// Panggil file koneksi
include 'koneksi.php';

// Tentukan Kode Admin Rahasia Anda
// Ganti 'ADMIN_RAHASIA_123' dengan kode apa pun yang Anda inginkan
define('SECRET_ADMIN_CODE', 'ADMIN_RAHASIA_123');

// Siapkan variabel untuk pesan error/sukses
$error_message = '';
$success_message = '';

// Cek apakah form sudah di-submit (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil data dari form (dan amankan)
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Kita ambil password mentah dulu
    $konfirmasi_password = $_POST['konfirmasi_password'];
    $kode_admin = $_POST['kode_admin']; // Ambil kode admin

    // 2. Validasi Input
    if (empty($nama_lengkap) || empty($email) || empty($password) || empty($konfirmasi_password)) {
        $error_message = "Semua bidang (kecuali Kode Admin) wajib diisi.";
    } 
    // Cek apakah password cocok
    elseif ($password !== $konfirmasi_password) {
        $error_message = "Password dan Konfirmasi Password tidak cocok.";
    } 
    // Cek apakah email valid
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid.";
    } 
    // Cek apakah email sudah ada
    else {
        // Gunakan prepared statement untuk keamanan
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $error_message = "Email ini sudah terdaftar. Silakan gunakan email lain.";
        } else {
            // 3. Semua validasi lolos, proses registrasi

            // Hash password (SANGAT PENTING!)
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Tentukan Role (Admin atau Pengguna)
            $role = 'pengguna'; // Default adalah 'pengguna'
            
            // Cek apakah user memasukkan kode admin yang benar
            if (!empty($kode_admin) && $kode_admin === SECRET_ADMIN_CODE) {
                $role = 'admin';
            }

            // 4. Masukkan data ke database (Gunakan Prepared Statement)
            $stmt_insert = $conn->prepare("INSERT INTO users (nama_lengkap, email, password, role) VALUES (?, ?, ?, ?)");
            // "ssss" berarti 4 variabel berikutnya adalah string
            $stmt_insert->bind_param("ssss", $nama_lengkap, $email, $password_hash, $role);

            if ($stmt_insert->execute()) {
                // Jika sukses, kirim pesan sukses via session dan arahkan ke login
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