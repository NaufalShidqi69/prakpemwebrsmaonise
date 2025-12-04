/**
 * File: js/konsul.js
 * Fitur: 
 * 1. Ambil data dokter & foto dari Database (get_dokter.php)
 * 2. Logika "Deep Conversation" untuk Spesialis Jantung (Demo Presentasi)
 * 3. Logika "General Keyword" untuk Spesialis Lainnya
 */

// Variabel Global
let allDoctors = []; 
let selectedDoctor = null;

// --- 1. AMBIL DATA DARI DATABASE ---
document.addEventListener('DOMContentLoaded', function() {
    fetch('get_dokter.php')
        .then(response => response.json())
        .then(data => {
            allDoctors = data;
            populateSpesialisasi();
        })
        .catch(error => console.error('Error mengambil data dokter:', error));
});

function populateSpesialisasi() {
    const selectSpesialis = document.getElementById('pilih-spesialis');
    // Ambil data unik
    const uniqueSpesialis = [...new Set(allDoctors.map(item => item.spesialisasi))];

    uniqueSpesialis.forEach(spesialis => {
        const option = document.createElement('option');
        option.value = spesialis;
        option.textContent = spesialis;
        selectSpesialis.appendChild(option);
    });
}

// --- 2. LOGIKA PILIH DOKTER ---
const selectSpesialis = document.getElementById('pilih-spesialis');
const selectDokter = document.getElementById('pilih-dokter');
const btnMulai = document.getElementById('btn-mulai-chat');

selectSpesialis.addEventListener('change', function() {
    const spesialisDipilih = this.value;
    const dokterTersedia = allDoctors.filter(doc => doc.spesialisasi === spesialisDipilih);

    selectDokter.innerHTML = '<option selected disabled>-- Pilih dokter --</option>';
    selectDokter.disabled = false;

    dokterTersedia.forEach(dok => {
        const option = document.createElement('option');
        option.value = dok.id_dokter;
        option.textContent = dok.nama_dokter;
        
        // Simpan data penting di atribut HTML
        option.setAttribute('data-foto', dok.foto_dokter); 
        option.setAttribute('data-nama', dok.nama_dokter);
        option.setAttribute('data-spesialis', dok.spesialisasi); 
        
        selectDokter.appendChild(option);
    });
});

selectDokter.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    // Simpan ke variabel global selectedDoctor
    selectedDoctor = {
        nama: selectedOption.getAttribute('data-nama'),
        foto: selectedOption.getAttribute('data-foto'),
        spesialis: selectedOption.getAttribute('data-spesialis')
    };
    btnMulai.disabled = false;
});

// --- 3. MULAI CHAT & UI ---
const btnKirim = document.getElementById('chat-send-btn');
const inputPesan = document.getElementById('chat-input-field');
const chatBody = document.getElementById('chat-body-area');

btnMulai.addEventListener('click', function() {
    document.getElementById('form-konsul').style.display = 'none';
    document.getElementById('chat-konsul').style.display = 'block';

    // Update Header
    const chatHeader = document.getElementById('chat-header-title');
    chatHeader.innerHTML = `
        <div class="d-flex align-items-center">
            <img src="${selectedDoctor.foto}" class="header-profile-img me-3" onerror="this.src='img/dokter/default.jpg'">
            <div>
                <h5 class="mb-0 text-white">${selectedDoctor.nama}</h5>
                <small class="text-white-50">Online • ${selectedDoctor.spesialis}</small>
            </div>
        </div>
    `;

    // Sapaan Awal (Beda Jantung vs Lainnya)
    setTimeout(() => {
        let sapaan = `Halo, saya ${selectedDoctor.nama}. `;
        if (selectedDoctor.spesialis.toLowerCase().includes('jantung')) {
            sapaan += "Silakan ceritakan keluhan jantung yang Anda rasakan secara detail.";
        } else {
            sapaan += "Ada yang bisa saya bantu hari ini?";
        }
        addMessage('bot', sapaan);
    }, 500);
});

btnKirim.addEventListener('click', sendMessage);
inputPesan.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') sendMessage();
});

function sendMessage() {
    const pesan = inputPesan.value;
    if (pesan.trim() !== "") {
        addMessage('user', pesan);
        inputPesan.value = '';
        
        // Efek mengetik...
        setTimeout(() => { 
            generateDoctorReply(pesan); 
        }, 800);
    }
}

function addMessage(sender, text) {
    const messageDiv = document.createElement('div');
    if (sender === 'bot') {
        messageDiv.className = 'chat-row bot';
        messageDiv.innerHTML = `
            <div class="chat-avatar-container">
                <img src="${selectedDoctor.foto}" class="chat-profile-img" onerror="this.src='img/dokter/default.jpg'">
            </div>
            <div class="chat-bubble bot-bubble">${text}</div>
        `;
    } else {
        messageDiv.className = 'chat-row user';
        messageDiv.innerHTML = `<div class="chat-bubble user-bubble">${text}</div>`;
    }
    chatBody.appendChild(messageDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

// ==========================================================
// === OTAK BOT UTAMA (Heart Logic + General Logic) ===
// ==========================================================

function generateDoctorReply(text) {
    const lowerText = text.toLowerCase();
    let reply = "";

    // Cek apakah dokter yang dipilih adalah SPESIALIS JANTUNG
    const isJantung = selectedDoctor.spesialis.toLowerCase().includes('jantung');

    if (isJantung) {
        // --- A. LOGIKA KHUSUS JANTUNG (Detail & Nyambung) ---
        
        // 1. Keluhan Awal
        if (lowerText.includes('halo') || lowerText.includes('pagi') || lowerText.includes('siang')) {
            reply = "Halo. Bisa jelaskan apa yang Anda rasakan? Apakah ada nyeri dada, jantung berdebar, atau sesak?";
        }
        // 2. Detail Nyeri Dada
        else if (lowerText.includes('sakit') || lowerText.includes('nyeri') || lowerText.includes('dada')) {
            reply = "Baik, fokus ke nyeri dadanya. Apakah rasanya **tajam menusuk** atau seperti **ditindih benda berat**?";
        }
        // 3. Karakteristik Nyeri
        else if (lowerText.includes('berat') || lowerText.includes('tindih') || lowerText.includes('tekan')) {
            reply = "Nyeri seperti ditindih adalah tanda khas. Apakah nyerinya **menjalar** ke bagian tubuh lain (lengan kiri, leher, rahang)?";
        }
        else if (lowerText.includes('tajam') || lowerText.includes('tusuk')) {
            reply = "Nyeri tajam biasanya masalah otot atau lambung (GERD), bukan jantung. Tapi apakah sakitnya bertambah saat menarik napas?";
        }
        // 4. Penjalaran & Gejala Penyerta
        else if (lowerText.includes('menjalar') || lowerText.includes('leher') || lowerText.includes('lengan') || lowerText.includes('rahang')) {
            reply = "Ini gejala Angina Pectoris. Apakah saat ini disertai **keringat dingin**, mual, atau sesak napas?";
        }
        // 5. Kondisi Darurat
        else if (lowerText.includes('keringat') || lowerText.includes('mual') || lowerText.includes('dingin')) {
            reply = "Bapak/Ibu, gejala ini mengarah ke **Serangan Jantung Akut**. <br><br><b>Saran Medis: Segera ke IGD RS Siloam/Maonis sekarang juga.</b> Jangan menunda.";
        }
        // 6. Masalah Berdebar
        else if (lowerText.includes('debar') || lowerText.includes('dag dig dug')) {
            reply = "Jantung berdebar bisa karena stres, kafein, atau aritmia. Apakah muncul tiba-tiba tanpa aktivitas fisik?";
        }
        // 7. Permintaan Obat Jantung
        else if (lowerText.includes('obat') || lowerText.includes('resep')) {
            reply = `
                Untuk pertolongan pertama nyeri dada (Angina), saya resepkan:
                <br>1. <b>ISDN 5mg</b> (Bawah lidah)
                <br>2. <b>Aspilet/Aspirin 80mg</b> (Pengencer darah)
                <br><br>
                <a href="#" class="btn btn-sm btn-primary">Tebus Resep Digital</a>
            `;
        }
        else {
            reply = "Maaf, saya kurang mengerti. Bisa jelaskan lagi keluhan jantungnya? (Cth: Nyeri dada, sesak, berdebar)";
        }

    } else {
        // --- B. LOGIKA UMUM (Penyakit Lain: Kulit, Anak, Gigi, dll) ---
        
        // Kamus kata kunci sederhana
        const generalResponses = {
            'kulit': "Apakah kulitnya gatal, kemerahan, atau ada benjolan?",
            'gatal': "Gatal bisa karena alergi atau jamur. Coba ingat, apakah habis makan seafood atau ganti sabun?",
            'jerawat': "Untuk jerawat, hindari makanan berminyak. Saya bisa resepkan krim Benzoil Peroksida.",
            
            'anak': "Berapa usia anaknya? Apa keluhannya, demam atau batuk pilek?",
            'demam': "Sudah berapa hari demamnya? Jika > 38 derajat, silakan beri Paracetamol sirup.",
            'batuk': "Batuk kering atau berdahak? Pastikan anak banyak minum air hangat ya.",
            
            'gigi': "Sakit giginya berdenyut atau ngilu saat minum dingin?",
            'bengkak': "Gusi bengkak biasanya karena infeksi atau karang gigi. Perlu dibersihkan (scaling).",
            'lubang': "Gigi berlubang harus ditambal agar tidak infeksi sampai ke saraf.",
            
            'perut': "Sakit perut sebelah mana? Ulu hati (maag) atau kanan bawah?",
            'maag': "Hindari kopi dan pedas dulu ya. Minum obat antasida sebelum makan.",
            'diare': "Hati-hati dehidrasi. Minum oralit setiap kali BAB cair.",
            
            'resep': "Baik, resep obat akan saya kirimkan ke aplikasi farmasi Anda.",
            'obat': "Tentu, saya buatkan resepnya sesuai keluhan Anda.",
            'makasih': "Sama-sama, semoga lekas sembuh!",
            'terima kasih': "Sama-sama, jaga kesehatan ya."
        };

        let found = false;
        // Cari kata kunci di input user
        for (const key in generalResponses) {
            if (lowerText.includes(key)) {
                reply = generalResponses[key];
                found = true;
                break;
            }
        }

        if (!found) {
            reply = "Baik, keluhan dicatat. Apakah ada gejala lain yang dirasakan? Atau ingin saya buatkan resep?";
        }
    }

    // Tampilkan Balasan Bot
    addMessage('bot', reply);
}
