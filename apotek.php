<?php
include 'koneksi.php';
$obatList = [];
$sql = "SELECT nama, deskripsi, gambar_url FROM tb_apotek";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $obatList[] = $row;
    }
} else {
    echo "Tidak ada data obat ditemukan.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek Online (dari Database)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        
        .grid-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); 
            gap: 20px; 
        }

        
        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
            color: #0056b3;
           
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
       
        #modalGambar {
            width: 100%; 
            max-width: 300px; 
            display: block;
            margin: 15px auto;
            border-radius: 8px;
        }
        
       
        .lokasi {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .lokasi h4 {
            margin: 0 0 10px 0;
        }
        
        #modalLokasi {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>

    <h1>Daftar Obat Resep Anda</h1>

    <div class="grid-container">
        <?php foreach ($obatList as $obat): ?>
            <div class="card" 
                 data-nama="<?php echo htmlspecialchars($obat['nama']); ?>" 
                 data-deskripsi="<?php echo htmlspecialchars($obat['deskripsi']); ?>"
                 data-gambar="<?php echo htmlspecialchars($obat['gambar_url']); ?>" 
            >
                <h3><?php echo htmlspecialchars($obat['nama']); ?></h3>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="obatModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalNama">Nama Obat</h2>
            
            <img id="modalGambar" src="" alt="Gambar Obat">
            
            <p id="modalDeskripsi">Deskripsi akan muncul di sini.</p>
            
            <div class="lokasi">
                <h4>Lokasi Apotek Terdekat:</h4>
                <p id="modalLokasi">Mencari lokasi...</p>
            </div>
        </div>
    </div>

    <script>
        
        var modal = document.getElementById("obatModal");
        var modalNama = document.getElementById("modalNama");
        var modalDeskripsi = document.getElementById("modalDeskripsi");
        var modalLokasi = document.getElementById("modalLokasi");
        var modalGambar = document.getElementById("modalGambar");
        var spanClose = document.getElementsByClassName("close")[0];
        var cards = document.querySelectorAll(".card");

        var daftarNamaApotek = [
            'Apotek Sehat Selalu',
            'Kimia Farma',
            'Apotek K-24',
            'Guardian Pharmacy',
            'Apotek Century',
            'Watsons'
        ];

      
        function simulasiLokasiApotek() {
          
            var indexAcak = Math.floor(Math.random() * daftarNamaApotek.length);
            var namaApotek = daftarNamaApotek[indexAcak];

            
            var jarakAngka = Math.random(); 
            var jarakString = "";
            if (jarakAngka < 0.2) {
                jarakString = "<200 m";
            } else if (jarakAngka < 0.6) {
                jarakString = "<600 m";
            } else {
                jarakString = (jarakAngka * 2).toFixed(1) + " km"; 
            }
           
            return {
                nama: namaApotek,
                jarak: jarakString
            };
        }

       
        cards.forEach(function(card) {
            card.addEventListener("click", function() {
               
                var nama = card.getAttribute("data-nama");
                var deskripsi = card.getAttribute("data-deskripsi");
                var gambar = card.getAttribute("data-gambar"); 

              
                modalNama.textContent = nama;
                modalDeskripsi.textContent = deskripsi;
                
               
                if (gambar && gambar !== "") {
                    modalGambar.src = gambar;         
                    modalGambar.style.display = "block"; 
                } else {
                    modalGambar.src = "";             
                    modalGambar.style.display = "none";  
                }
                
                modal.style.display = "block";
                
                modalLokasi.textContent = "Mencari...";
                setTimeout(function() {
                    var lokasiApotek = simulasiLokasiApotek(); 
                    modalLokasi.textContent = lokasiApotek.nama + " (sekitar " + lokasiApotek.jarak + ")";
                }, 1000); 
            });
        });

        spanClose.onclick = function() {
            modal.style.display = "none";
        }
       
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
