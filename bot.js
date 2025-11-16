document.addEventListener("DOMContentLoaded", function() {

    // === 1. DEFINISI PERTANYAAN & JAWABAN (Sama seperti sebelumnya) ===
    const faqData = {
        'q1': { 'pertanyaan': 'Jam operasional rumah sakit?', 'jawaban': 'UGD kami siap melayani 24 jam. Untuk Poliklinik (Rawat Jalan), jam operasional normal adalah Senin - Sabtu, pukul 08:00 - 21:00.' },
        'q2': { 'pertanyaan': 'Di mana lokasi RS Maonise?', 'jawaban': 'Kami berlokasi di Jl. Sehat Selalu No. 123, Yogyakarta. Anda bisa menemukan kami di Google Maps dengan kata kunci "RS Maonise".' },
        'q3': { 'pertanyaan': 'Bagaimana cara buat janji temu?', 'jawaban': 'Anda bisa buat janji melalui 3 cara: <br>1. Online di website ini (menu "Buat Janji"). <br>2. Telepon ke (0274) 123-456. <br>3. Datang langsung ke bagian pendaftaran.' },
        'q4': { 'pertanyaan': 'Apakah RS ini menerima BPJS?', 'jawaban': 'Ya, kami menerima pasien BPJS Kesehatan. Pastikan membawa kartu BPJS aktif, KTP, dan surat rujukan dari Faskes 1 (jika ada) saat mendaftar.' },
        'q5': { 'pertanyaan': 'Ada dokter spesialis apa saja?', 'jawaban': 'Kami memiliki banyak spesialis, termasuk Poli Jantung, Poli Anak, Poli Gigi, Poli Mata, Poli Kandungan, dan masih banyak lagi. Cek menu "Dokter" untuk daftar lengkap.' },
        'q6': { 'pertanyaan': 'Bagaimana cara melihat jadwal dokter?', 'jawaban': 'Jadwal lengkap semua dokter kami tersedia di halaman "Jadwal Dokter". Anda bisa memfilter berdasarkan nama dokter atau spesialisasi.' },
        'q7': { 'pertanyaan': 'Fasilitas rawat inap apa saja?', 'jawaban': 'Kami menyediakan ruang rawat inap VVIP, VIP, Kelas 1, Kelas 2, dan Kelas 3. Lihat halaman "Fasilitas" untuk detail foto dan fasilitas setiap kamar.' },
        'q8': { 'pertanyaan': 'Berapa biaya konsultasi dokter?', 'jawaban': 'Biaya konsultasi bervariasi tergantung spesialisasi dokter. Untuk informasi lebih detail mengenai tarif, silakan hubungi bagian informasi kami di (0274) 123-456.' },
        'q9': { 'pertanyaan': 'Nomor telepon UGD/Darurat?', 'jawaban': 'Untuk keadaan darurat, silakan segera hubungi UGD kami di nomor <strong>(0274) 555-111</strong>. Kami siap 24 jam.' },
        'q10': { 'pertanyaan': 'Apa itu Medical Check Up (MCU)?', 'jawaban': 'MCU adalah paket pemeriksaan kesehatan menyeluruh untuk mendeteksi dini potensi penyakit. Kami memiliki beberapa paket MCU, mulai dari dasar hingga lengkap.' },
        'q11': { 'pertanyaan': 'Jam besuk pasien kapan?', 'jawaban': 'Jam besuk pasien rawat inap adalah: <br>Pagi: 10:00 - 12:00 <br>Sore: 17:00 - 19:00. <br>Harap patuhi jam besuk demi kenyamanan pasien.' },
        'q12': { 'pertanyaan': 'Fasilitas penunjang apa saja?', 'jawaban': 'Kami didukung fasilitas penunjang medis lengkap seperti Laboratorium 24 jam, Radiologi (X-Ray, CT-Scan), Farmasi/Apotek 24 jam, dan Ambulans.' },
        'q13': { 'pertanyaan': 'Prosedur pendaftaran UGD?', 'jawaban': 'Pasien UGD bisa langsung datang ke bagian Triage UGD. Keluarga pasien kemudian bisa melakukan pendaftaran di loket UGD dengan membawa KTP/identitas pasien.' },
        'q14': { 'pertanyaan': 'Apakah ada apotek 24 jam?', 'jawaban': 'Ya, Farmasi/Apotek kami beroperasi 24 jam non-stop, melayani resep untuk pasien rawat jalan, rawat inap, UGD, dan juga resep dari luar.' },
        'q15': { 'pertanyaan': 'Bagaimana cara menghubungi Humas?', 'jawaban': 'Untuk pertanyaan umum, keluhan, atau informasi lainnya, Anda dapat menghubungi bagian Informasi kami di (0274) 123-456 atau email ke info@Maonise.com.' }
    };

    // === 2. AMBIL ELEMEN HTML ===
    const botToggle = document.getElementById('bot-toggle');
    const botWindow = document.getElementById('bot-window');
    const botClose = document.getElementById('bot-close');
    const chatArea = document.getElementById('bot-chat-area');

    let isBotOpen = false;

    // === 3. FUNGSI-FUNGSI CHAT (Sama seperti sebelumnya) ===

    function scrollToBottom() {
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    function appendBotMessage(htmlContent) {
        const messageWrapper = document.createElement('div');
        messageWrapper.className = 'chat-message bot-message';
        messageWrapper.innerHTML = `
            <div class="bot-icon">
                <i class="bi bi-robot"></i>
            </div>
            <div class="chat-bubble">
                ${htmlContent}
            </div>
        `;
        chatArea.appendChild(messageWrapper);
        scrollToBottom();
    }

    function appendUserMessage(text) {
        const messageWrapper = document.createElement('div');
        messageWrapper.className = 'chat-message user-message';
        messageWrapper.innerHTML = `
            <div class="chat-bubble">
                ${text}
            </div>
        `;
        chatArea.appendChild(messageWrapper);
        scrollToBottom();
    }

    // --- FUNGSI INI KITA MODIFIKASI ---
    function showQuestionOptions() {
        const questionsContainer = document.createElement('div');
        questionsContainer.className = 'bot-questions-container';

        for (const key in faqData) {
            const button = document.createElement('button');
            // Kita tambahkan class 'bot-question-btn' untuk identifikasi
            button.className = 'btn btn-outline-primary bot-question-btn';
            button.innerHTML = faqData[key].pertanyaan;
            button.setAttribute('data-key', key);
            
            // !!! KITA HAPUS event listener dari sini !!!
            
            questionsContainer.appendChild(button);
        }
        
        appendBotMessage(questionsContainer.outerHTML);
    }
    
    function handleQuestionClick(key) {
        const qText = faqData[key].pertanyaan;
        const aText = faqData[key].jawaban;

        // 1. Hapus opsi pertanyaan lama
        const oldQuestions = chatArea.querySelector('.bot-questions-container');
        if (oldQuestions) {
            // Hapus bubble chat yang berisi tombol-tombol
            oldQuestions.closest('.bot-message').remove();
        }

        // 2. Tampilkan pertanyaan user sebagai chat user
        appendUserMessage(qText);

        // 3. Tampilkan jawaban bot
        setTimeout(() => {
            appendBotMessage(aText);

            // 4. Tampilkan pertanyaan "Ada lagi?" dan opsi lagi
            setTimeout(() => {
                appendBotMessage("Ada lagi yang bisa saya bantu? Silakan pilih topik lain di bawah ini.");
                showQuestionOptions();
            }, 1000);

        }, 500);
    }

    function startChat() {
        chatArea.innerHTML = ''; 
        appendBotMessage("Halo! Saya Maonise Bot. Ada yang bisa saya bantu? Silakan pilih salah satu pertanyaan di bawah ini.");
        showQuestionOptions();
    }

    // === 4. EVENT LISTENERS UNTUK BUKA/TUTUP (Sama) ===
    
    function toggleBot() {
        if (isBotOpen) {
            botWindow.style.opacity = '0';
            botWindow.style.transform = 'translateY(20px)';
            setTimeout(() => { botWindow.style.display = 'none'; }, 300);
        } else {
            botWindow.style.display = 'flex';
            setTimeout(() => { 
                botWindow.style.opacity = '1';
                botWindow.style.transform = 'translateY(0)';
            }, 10);
            startChat();
        }
        isBotOpen = !isBotOpen;
    }

    botToggle.addEventListener('click', toggleBot);
    botClose.addEventListener('click', toggleBot);


    // === 5. INI ADALAH PERBAIKANNYA (EVENT DELEGATION) ===
    // Kita menempelkan SATU listener ke 'chatArea'
    
    chatArea.addEventListener('click', function(event) {
        // 'event.target' adalah elemen yang DIKLIK (bisa jadi teks di dalam tombol)
        // '.closest()' akan mencari elemen terdekat yang cocok dengan '.bot-question-btn'
        
        const clickedButton = event.target.closest('.bot-question-btn');

        // Jika yang diklik adalah tombol (bukan area lain)
        if (clickedButton) {
            const key = clickedButton.getAttribute('data-key');
            if (key) {
                // Panggil fungsi handle
                handleQuestionClick(key);
            }
        }
    });

});