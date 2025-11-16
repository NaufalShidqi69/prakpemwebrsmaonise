<?php
// --- 1. MULAI SESSION & KONEKSI ---
// session_start() harus diletakkan di baris paling atas
session_start();
include 'koneksi.php';

// Siapkan variabel
$error_message = '';
$success_message = '';

// Cek apakah ada pesan sukses dari halaman registrasi
if (isset($_SESSION['register_success'])) {
    $success_message = $_SESSION['register_success'];
    // Hapus session agar tidak muncul lagi saat di-refresh
    unset($_SESSION['register_success']);
}

// Cek apakah user sudah login, jika ya, arahkan
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: indexadmin.php");
    exit;
} elseif (isset($_SESSION['user_logged_in'])) {
    header("Location: index.php"); // Ganti 'index.php' jika nama beranda user Anda beda
    exit;
}

// --- 2. PROSES FORM JIKA DI-SUBMIT ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error_message = "Email dan Password wajib diisi.";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // --- 3. KEAMANAN: GUNAKAN PREPARED STATEMENT ---
        // Ambil data user dari database berdasarkan email
        $stmt = $conn->prepare("SELECT id, nama_lengkap, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Cek apakah email ditemukan
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // --- 4. KEAMANAN: VERIFIKASI PASSWORD HASH ---
            if (password_verify($password, $user['password'])) {
                // Password benar, login berhasil
                
                // --- 5. LOGIKA ROLE (ADMIN / PENGGUNA) ---
                if ($user['role'] == 'admin') {
                    // Jika dia ADMIN
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['id_admin'] = $user['id'];
                    $_SESSION['nama_admin'] = $user['nama_lengkap'];
                    $_SESSION['role'] = 'admin';
                    
                    // Arahkan ke dashboard admin
                    header("Location: indexadmin.php");
                    exit;
                    
                } elseif ($user['role'] == 'pengguna') {
                    // Jika dia PENGGGUNA BIASA
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['id_user'] = $user['id'];
                    $_SESSION['nama_user'] = $user['nama_lengkap'];
                    $_SESSION['role'] = 'pengguna';
                    
                    // Arahkan ke beranda pengguna (misal: index.php)
                    header("Location: index.php"); // Ganti 'index.php' jika perlu
                    exit;
                }
                
            } else {
                // Password salah
                $error_message = "Email atau password salah.";
            }
        } else {
            // Email tidak ditemukan
            $error_message = "Email atau password salah.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px; /* Sedikit lebih kecil dari registrasi */
            padding: 30px;
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2 class="text-center mb-4">Login Akun</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Login</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Belum punya akun? <a href="registrasi.php">Daftar di sini</a>
        </p>
    </div>

</body>
</html>
