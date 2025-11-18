/*
 * File: /js/konsul.js
 * Logika JavaScript untuk prototipe chat konsultasi.
 * (Versi BARU dengan resep yang relevan berdasarkan kata kunci)
 */

document.addEventListener("DOMContentLoaded", function() {

    // === 1. DATABASE DOKTER & KATA KUNCI ===

    // Data Dokter (Dummy)
    const allDoctors = {
        'dalam': ['Dr. Mega Wulandari, Sp.PD', 'Dr. Lutfi Hakim, Sp.B', 'Dr. Eko Prasetyo, Sp.OT'],
        'jantung': ['Dr. Amanda S., Sp.JP', 'Dr. Bima Sakti, Sp.N'],
        'kulit': ['Dr. Fina Febriani, Sp.KK', 'Dr. Haris Maulana, Sp.KJ'],
        'anak': ['Dr. Citra Lestari, Sp.A', 'Dr. Dian Permata, Sp.OG'],
        'gigi': ['Drg. Jaya Pratama', 'Dr. Guntur Wijaya, Sp.THT']
    };

    // "Otak" Bot: Daftar Kata Kunci dan Jawabannya
    const keywordResponses = {
        // Kata kunci umum
        'halo': "Halo juga. Silakan ketik keluhan utama Anda.",
        'selamat pagi': "Selamat pagi. Ada yang bisa saya bantu?",
        'terima kasih': "Sama-sama, semoga lekas sembuh.",
        
        // --- JANTUNG ---
        'jantung': "Baik, keluhan terkait jantung. Gejalanya apa? Apakah dada berdebar, nyeri dada, atau sesak napas?",
        'dada': "Nyeri dada sebelah mana? Apakah menjalar ke lengan atau leher? Berapa lama durasinya?",
        'berdebar': "Sejak kapan Anda merasakannya? Apakah ada pemicu khusus seperti setelah minum kopi atau kecapekan?",
        
        // --- KULIT ---
        'kulit': "Keluhan kulit ya. Apakah gatal, kemerahan, berjerawat, atau ada benjolan?",
        'gatal': "Gatal dan kemerahan bisa jadi alergi atau iritasi. Apakah Anda baru saja mengganti sabun atau deterjen?",
        'jerawat': "Jerawat parah (acne) butuh penanganan khusus. Boleh difotokan area jerawatnya? Sambil menunggu, jangan dipencet ya.",
        
        // --- ANAK / UMUM ---
        'demam': "Sudah berapa hari demamnya? Apakah sudah diukur suhunya? Jika ini untuk anak, berikan Paracetamol sesuai dosis.",
        'panas': "Sudah berapa hari demamnya? Apakah sudah diukur suhunya? Jika ini untuk anak, berikan Paracetamol sesuai dosis.",
        'anak': "Baik, ini untuk anak. Apa keluhannya? Demam, batuk pilek, atau ruam?",
        'batuk': "Batuk pilek pada anak biasanya karena virus. Pastikan anak cukup istirahat dan minum air putih. Jika sudah lebih dari 5 hari, baru kita beri obat.",
        
        // --- GIGI ---
        'gigi': "Sakit gigi ya? Apakah sakit berdenyut, gusi bengkak, atau ingin membersihkan karang?",
        'gusi': "Gusi bengkak dan berdarah adalah tanda radang gusi (gingivitis). Ini karena karang gigi. Anda harus scaling (pembersihan).",

        // --- DALAM (PENCERNAAN) ---
        'maag': "GERD (asam lambung naik) harus diatur pola makannya. Hindari kopi, pedas, dan asam. Jangan langsung tidur setelah makan.",
        'perut': "Sakit perut sebelah mana? Kanan bawah, atau ulu hati?",
        'diare': "Pastikan Anda minum banyak cairan (oralit) agar tidak dehidrasi. Jika sudah lebih dari 3 hari, perlu pemeriksaan lab.",

        // --- RESEP ---
        'obat': "Tentu, saya akan siapkan resepnya. Berdasarkan keluhan Anda, saya sarankan obat berikut ini.",
        'resep': "Baik, saya akan buatkan resep digital untuk Anda."
    };

    // === BAGIAN BARU: DATABASE RESEP ===
    // Ini menghubungkan KATA KUNCI dengan OBAT
    const prescriptionData = {
        // Kunci = kata kunci, Nilai = array [Nama Obat, Link Apotek (dummy)]
        'dada': [
            ['Aspirin 80mg', 'apotek.php?obat=aspirin'],
            ['ISDN 5mg', 'apotek.php?obat=isdn']
        ],
        'berdebar': [
            ['Bisoprolol 2.5mg', 'apotek.php?obat=bisoprolol']
        ],
        'gatal': [
            ['Cetirizine 10mg', 'apotek.php?obat=cetirizine'],
            ['Krim Hidrokortison 1%', 'apotek.php?obat=hidrokortison']
        ],
        'jerawat': [
            ['Benzoil Peroksida 5%', 'apotek.php?obat=benzoil'],
            ['Klindamisin Gel', 'apotek.php?obat=klindamisin']
        ],
        'demam': [
            ['Paracetamol 500mg', 'apotek.php?obat=paracetamol']
        ],
        'panas': [
            ['Ibuprofen 400mg', 'apotek.php?obat=ibuprofen']
        ],
        'batuk': [
            ['Ambroxol Sirup', 'apotek.php?obat=ambroxol'],
            ['Dekstrometorfan', 'apotek.php?obat=dmp']
        ],
        'gigi': [
            ['Asam Mefenamat 500mg', 'apotek.php?obat=mefenamat'],
            ['Amoxicillin 500mg', 'apotek.php?obat=amoxicillin']
        ],
        'gusi': [
            ['Obat Kumur Klorheksidin', 'apotek.php?obat=klorheksidin']
        ],
        'maag': [
            ['Antasida Sirup', 'apotek.php?obat=antasida'],
            ['Omeprazole 20mg', 'apotek.php?obat=omeprazole']
        ],
        'diare': [
            ['Oralit', 'apotek.php?obat=oralit'],
            ['Attapulgit', 'apotek.php?obat=attapulgit']
        ]
    };

    // === 2. AMBIL SEMUA ELEMEN HTML ===
    const formKonsul = document.getElementById('form-konsul');
    const chatKonsul = document.getElementById('chat-konsul');
    const selectSpesialis = document.getElementById('pilih-spesialis');
    const selectDokter = document.getElementById('pilih-dokter');
    const btnMulaiChat = document.getElementById('btn-mulai-chat');
    
    const chatHeaderTitle = document.getElementById('chat-header-title');
    const chatBody = document.getElementById('chat-body-area');
    const chatInputArea = document.getElementById('chat-input-area');
    const chatInputField = document.getElementById('chat-input-field');
    const chatSendBtn = document.getElementById('chat-send-btn');

    let currentDoctorName = ''; 
    // === BAGIAN BARU: Penyimpan Resep ===
    let currentSuggestedPrescription = []; // Menyimpan resep yang relevan

    // === 3. FUNGSI-FUNGSI CHAT ===

    function addBotMessage(html) {
        const key = chatBody.querySelectorAll('.chat-message').length; 
        const firstLetter = currentDoctorName.substring(0, 1);
        
        chatBody.innerHTML += `
            <div class="chat-message bot-message" id="msg-${key}">
                <div class="bot-icon" title="${currentDoctorName}">${firstLetter}</div>
                <div class="chat-bubble">${html}</div>
            </div>
        `;
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function addUserMessage(text) {
        chatBody.innerHTML += `
            <div class="chat-message user-message">
                <div class="chat-bubble">${text}</div>
            </div>
        `;
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    // === FUNGSI RESEP DIPERBARUI ===
    function showPrescription() {
        let prescriptionHTML = '';

        // Cek apakah ada resep yang tersimpan
        if (currentSuggestedPrescription.length > 0) {
            
            // Buat tombol untuk setiap obat yang relevan
            currentSuggestedPrescription.forEach(function(obat, index) {
                // Tentukan warna tombol (dummy)
                const btnClass = (index % 2 === 0) ? 'btn-success' : 'btn-warning';
                
                prescriptionHTML += `
                    <a href="${obat[1]}" target="_blank" class="btn ${btnClass} btn-sm mt-2">
                        <i class="bi bi-capsule me-2"></i> Resep: ${obat[0]}
                    </a>
                `;
            });

        } else {
            // Jika user langsung minta obat tanpa keluhan
            prescriptionHTML = "Maaf, saya perlu tahu dulu keluhan Anda sebelum bisa memberikan resep.";
            // Tetapkan resep default jika mereka bertanya lagi
            currentSuggestedPrescription = [
                ['Paracetamol 500mg', 'apotek.php?obat=paracetamol']
            ];
        }

        // Tampilkan resepnya
        addBotMessage(`
            Ini adalah resep digital Anda. Silakan klik untuk info detail:
            <br>
            ${prescriptionHTML}
        `);
        
        // Tawarkan untuk mengakhiri
        setTimeout(() => {
            addBotMessage("Konsultasi selesai. Apakah ada lagi yang bisa saya bantu?");
        }, 1000);
    }
    
    // === FUNGSI "OTAK" BOT DIPERBARUI ===
    function processUserInput(userInput) {
        const lowerInput = userInput.toLowerCase();
        let response = "Maaf, saya tidak mengerti keluhan Anda. Bisa gunakan istilah lain? (Cth: 'dada', 'demam', 'gigi', 'kulit', 'obat')";
        let foundKeyword = false;

        // Cek kata kunci resep dulu (prioritas)
        if (lowerInput.includes('obat') || lowerInput.includes('resep')) {
            response = keywordResponses['resep'];
            foundKeyword = true;
            
            // Tampilkan jawaban dan langsung panggil resep
            setTimeout(() => {
                addBotMessage(response);
                setTimeout(showPrescription, 1000); // Panggil fungsi resep
            }, 500);
            return; // Hentikan fungsi di sini
        }

        // Cek kata kunci keluhan
        for (const keyword in keywordResponses) {
            if (lowerInput.includes(keyword)) {
                response = keywordResponses[keyword];
                foundKeyword = true;
                
                // === BAGIAN BARU: Simpan resep yang relevan ===
                if (prescriptionData[keyword]) {
                    currentSuggestedPrescription = prescriptionData[keyword];
                }
                // ===============================================
                
                break; // Hentikan loop jika sudah ketemu
            }
        }

        // Tampilkan jawaban bot setelah jeda
        setTimeout(() => {
            addBotMessage(response);
        }, 500); // Jeda 0.5 detik
    }
    
    // Fungsi untuk mengirim chat
    function sendChat() {
        const userInput = chatInputField.value;
        if (userInput.trim() === "") {
            return; // Jangan kirim jika kosong
        }
        
        addUserMessage(userInput);
        chatInputField.value = "";
        processUserInput(userInput);
    }


    // === 4. EVENT LISTENERS (Sama seperti sebelumnya) ===

    selectSpesialis.addEventListener('change', function() {
        let currentSpecialty = this.value; 
        const doctors = allDoctors[currentSpecialty];
        
        selectDokter.innerHTML = '<option selected disabled>-- Pilih dokter --</option>'; 
        
        if (doctors) {
            doctors.forEach(function(doctorName) {
                selectDokter.innerHTML += `<option value="${doctorName}">${doctorName}</option>`;
            });
            selectDokter.disabled = false;
        } else {
            selectDokter.innerHTML = '<option selected disabled>-- Dokter tidak tersedia --</option>';
            selectDokter.disabled = true;
        }
        btnMulaiChat.disabled = true; 
    });

    selectDokter.addEventListener('change', function() {
        currentDoctorName = this.value;
        btnMulaiChat.disabled = false; 
    });

    btnMulaiChat.addEventListener('click', function() {
        formKonsul.style.display = 'none';
        chatKonsul.style.display = 'block';

        chatHeaderTitle.innerHTML = `Konsultasi dengan ${currentDoctorName}`;

        addBotMessage(`Halo, saya ${currentDoctorName}. Silakan ketik keluhan utama Anda.`);
    });
    
    chatSendBtn.addEventListener('click', sendChat);
    
    chatInputField.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendChat();
        }
    });

});