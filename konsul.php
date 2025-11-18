<?php 
// 1. Memanggil file header.php
include 'header.php'; 
?>

<link rel="stylesheet" href="css/konsul.css">


<div class="container py-5">

    <div id="form-konsul" class="card shadow-sm border-0 p-4 p-md-5 mx-auto" style="max-width: 700px;">
        <h1 class="display-5 fw-bold text-center mb-4">Mulai Konsultasi Online</h1>
        <p class="text-center text-muted mb-4">Silakan pilih spesialis dan dokter yang Anda tuju untuk memulai sesi konsultasi.</p>
        
        <div class="mb-3">
            <label for="pilih-spesialis" class="form-label fw-bold">1. Pilih Spesialisasi</label>
            <select class="form-select form-select-lg" id="pilih-spesialis">
                <option selected disabled>-- Pilih spesialisasi --</option>
                <option value="dalam">Spesialis Penyakit Dalam</option>
                <option value="jantung">Spesialis Jantung</option>
                <option value="kulit">Spesialis Kulit & Kelamin</option>
                <option value="anak">Spesialis Anak</option>
                <option value="gigi">Dokter Gigi Umum</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="pilih-dokter" class="form-label fw-bold">2. Pilih Dokter</label>
            <select class="form-select form-select-lg" id="pilih-dokter" disabled>
                <option selected>-- Pilih dokter --</option>
            </select>
        </div>

        <button class="btn btn-primary btn-lg w-100" id="btn-mulai-chat" disabled>
            Mulai Chat
        </button>
    </div>


    <div id="chat-konsul" style="display: none;">
        
        <div class="chat-header" id="chat-header-title">
            </div>

        <div class="chat-body" id="chat-body-area">
            </div>

        <div class="chat-input-area" id="chat-input-area">
            <div class="input-group">
                <input type="text" class="form-control" id="chat-input-field" placeholder="Ketik keluhan Anda di sini...">
                <button class="btn btn-primary" type="button" id="chat-send-btn">
                    <i class="bi bi-send-fill"></i> Kirim
                </button>
            </div>
        </div>

    </div>

</div> <script src="js/konsul.js"></script>


<?php 
// 4. Memanggil file footer.php
include 'footer.php'; 
?>
