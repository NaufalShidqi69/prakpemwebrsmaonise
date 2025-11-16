<?php
// Ambil nama file halaman saat ini
$currentPage = basename($_SERVER['PHP_SELF']);

// Daftar halaman di mana bot TIDAK boleh muncul
$noBotPages = [
    'konsul.php',
    'login.php',
    'register.php',
    'indexadmin.php' 
    // Tambahkan halaman admin lain jika ada, cth: 'admin_dokter.php'
];

// Periksa: Jika halaman saat ini BUKAN salah satu dari daftar $noBotPages,
// maka tampilkan HTML bot.
if (!in_array($currentPage, $noBotPages)) :
?>

<div id="bot-toggle" class="shadow">
    <i class="bi bi-robot"></i>
</div>

<div id="bot-window" class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
        <div class="d-flex align-items-center">
            <i class="bi bi-robot fs-4 me-2"></i>
            <h5 class="mb-0">Maonise Bot</h5>
        </div>
        <button id="bot-close" type="button" class="btn-close btn-close-white"></button>
    </div>
    
    <div class="card-body" id="bot-chat-area">
        </div>
</div>


<style>
    /* Tombol Toggle */
    #bot-toggle {
        position: fixed;
        bottom: 25px;
        right: 25px;
        width: 60px;
        height: 60px;
        background-color: var(--bs-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        cursor: pointer;
        z-index: 999;
        transition: all 0.3s ease;
    }
    #bot-toggle:hover {
        transform: scale(1.1);
    }

    /* Jendela Bot */
    #bot-window {
        position: fixed;
        bottom: 100px;
        right: 25px;
        width: 370px; /* Sedikit lebih lebar */
        max-width: 90%;
        height: 500px;
        max-height: 80vh;
        border-radius: 15px;
        overflow: hidden;
        z-index: 1000;
        display: none;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
        flex-direction: column;
    }
    /* Header bot */
    #bot-window .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* AREA CHAT CSS (PENTING)
      Ini adalah kunci untuk scroll
    */
    #bot-chat-area {
        flex-grow: 1; /* Mengisi sisa ruang */
        display: flex;
        flex-direction: column; /* Pesan ditumpuk ke bawah */
        padding: 10px;
        overflow-y: auto; /* INI YANG MEMBUAT BISA SCROLL */
        background-color: #f7f9fa;
    }

    /* Wrapper untuk setiap baris chat */
    .chat-message {
        display: flex;
        margin-bottom: 15px;
        max-width: 90%;
        gap: 15px; /* <-- TAMBAHKAN BARIS INI */
    }

    /* Pesan dari BOT (Kiri) */
    .bot-message {
        align-self: flex-start; /* Rata kiri */
    }
    .bot-message .chat-bubble {
        background-color: #ffffff;
        border: 1px solid #eee;
        color: #333;
        border-radius: 0 15px 15px 15px;
    }
    
    /* Pesan dari USER (Kanan) */
    .user-message {
        align-self: flex-end; /* Rata kanan */
    }
    .user-message .chat-bubble {
        background-color: var(--bs-primary);
        color: white;
        border-radius: 15px 0 15px 15px;
    }

    /* Bubble chat */
    .chat-bubble {
        padding: 12px 18px;
        font-size: 0.95rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    /* Ikon Bot */
    .bot-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        background-color: var(--bs-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    /* Kontainer untuk tombol OPSI */
    .bot-questions-container {
        display: flex;
        flex-direction: column;
        gap: 8px; /* Jarak antar tombol */
        padding: 10px 0;
    }
    .bot-questions-container .btn {
        text-align: left;
        font-size: 0.9rem;
        border-radius: 10px;
    }
</style>

<script src="js/bot.js"></script>

<?php
endif; // Penutup if(!in_array(...))
?>
