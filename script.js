// Menunggu sampai seluruh halaman HTML selesai dimuat
document.addEventListener('DOMContentLoaded', function() {

    // 1. Temukan formulir dan modal di HTML
    const riskForm = document.getElementById('riskForm');
    const resultModalElement = document.getElementById('resultModal');
    
    // 2. Buat "objek" modal Bootstrap agar bisa kita perintahkan (show/hide)
    const resultModal = new bootstrap.Modal(resultModalElement);

    // 3. Dengarkan" kapan tombol "Lanjut" (submit) di dalam form diklik
    riskForm.addEventListener('submit', function(event) {
        
        // 4. Mencegah form me-refresh halaman (INI SANGAT PENTING)
        event.preventDefault(); 

        // 5. Ambil semua nilai dari input
        const gender = document.querySelector('input[name="gender"]:checked');
        const smoker = document.querySelector('input[name="smoker"]:checked');
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);
        const age = document.getElementById('age').value;
        const bp = document.getElementById('bp').value;

        // 6. Validasi sederhana (pastikan semua terisi)
        if (!gender || !smoker || !weight || !height || !age || !bp) {
            alert('Harap isi semua data di formulir terlebih dahulu.');
            return; // Hentikan fungsi
        }

        // 7. Logika Kalkulator (Ini hanya contoh sederhana)
        let riskScore = 0;

        // Poin berdasarkan umur
        if (age === '40-59') riskScore += 10;
        if (age === '60+') riskScore += 20;

        // Poin berdasarkan merokok
        if (smoker.value === 'yes') riskScore += 20;
        
        // Poin berdasarkan Tekanan Darah
        if (bp === 'elevated') riskScore += 10;
        if (bp === 'high') riskScore += 25;

        // Poin berdasarkan BMI (Indeks Massa Tubuh)
        const heightInMeters = height / 100;
        const bmi = weight / (heightInMeters * heightInMeters);
        
        if (bmi >= 25 && bmi < 30) riskScore += 10; // Overweight
        if (bmi >= 30) riskScore += 20; // Obesitas

        // 8. Siapkan hasil berdasarkan skor
        let title, description, percent, iconClass, titleClass, buttonPrimaryClass, buttonSecondaryClass;

        if (riskScore < 20) {
            title = "Berisiko rendah";
            percent = riskScore + "%";
            description = "Selamat, risiko jantung Anda termasuk dalam kategori <b>Rendah / Low Risk</b>. Jaga terus kondisi kesehatan jantung Anda dengan melakukan pemeriksaan jantung rutin. Jangan sampai risiko jantung Anda meningkat tahun depan!";
            iconClass = "bi-shield-fill-check icon-low"; // Ikon hijau untuk rendah
            titleClass = "risk-low"; // Warna hijau untuk judul
            buttonPrimaryClass = "btn-primary"; // Warna tombol default
            buttonSecondaryClass = "btn-outline-primary"; // Warna tombol default
        } else if (riskScore < 45) {
            title = "Risiko Menengah";
            percent = riskScore + "%";
            description = "Risiko jantung Anda <b>Menengah</b>. Sebaiknya Anda mulai memperhatikan pola makan dan berolahraga secara teratur untuk mengurangi risiko di masa depan.";
            iconClass = "bi-exclamation-triangle-fill icon-medium"; // Ikon kuning untuk menengah
            titleClass = "risk-medium"; // Warna kuning untuk judul
            buttonPrimaryClass = "btn-warning text-dark"; // Tombol kuning
            buttonSecondaryClass = "btn-outline-warning text-dark"; // Tombol kuning
        } else {
            title = "Risiko Tinggi";
            percent = riskScore + "%";
            description = "Risiko jantung Anda <b>Tinggi</b>. Kami sangat menyarankan Anda untuk segera berkonsultasi dengan dokter spesialis jantung untuk pemeriksaan lebih lanjut dan rencana penanganan.";
            iconClass = "bi-heartbreak-fill icon-high"; // Ikon merah untuk tinggi
            titleClass = "risk-high"; // Warna merah untuk judul
            buttonPrimaryClass = "btn-danger"; // Tombol merah
            buttonSecondaryClass = "btn-outline-danger"; // Tombol merah
        }

        // 9. Masukkan hasil kalkulasi ke dalam HTML Modal
        // Mengatur kelas ikon (termasuk kelas CSS baru)
        document.getElementById('modalIcon').className = "bi custom-modal-icon " + iconClass;
        
        // Mengatur teks judul
        document.getElementById('modalTitle').textContent = title;
        
        // Mengatur kelas warna judul (termasuk kelas CSS baru)
        document.getElementById('modalTitle').className = "custom-modal-title mb-2 " + titleClass;
        
        // Mengatur teks persentase
        document.getElementById('modalPercent').textContent = percent;
        
        // Mengatur deskripsi (menggunakan .innerHTML agar tag <b> terbaca)
        document.getElementById('modalDescription').innerHTML = description;

        // 9b. (Opsional tapi disarankan) Mengatur warna tombol
        const primaryBtn = resultModalElement.querySelector('.custom-modal-btn-primary');
        const secondaryBtn = resultModalElement.querySelector('.custom-modal-btn-secondary');
        
        // Mereset kelas tombol dan menambahkan kelas warna yang baru
        primaryBtn.className = `btn w-75 custom-modal-btn-primary mb-2 ${buttonPrimaryClass}`;
        secondaryBtn.className = `btn w-75 custom-modal-btn-secondary ${buttonSecondaryClass}`;

        // 10. Tampilkan Modal!
        resultModal.show();
    });

});