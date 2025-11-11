<?php 
// 1. Memanggil header
include 'header.php'; 
?>

<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            
            <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-body p-4 p-md-5">

                    <h2 class="text-center fw-bold mb-4">Login Akun</h2>
                    
                    <form action="proses_login.php" method="POST">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password Anda" required>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>

                    </form>

                    <p class="text-center text-muted mt-4 mb-0">
                        Belum punya akun? <a href="register.php">Daftar di sini</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// 2. Memanggil footer
include 'footer.php'; 
?>