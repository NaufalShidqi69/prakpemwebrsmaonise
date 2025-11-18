<?php
include 'header.php';

$obatList = [];

$sql = "SELECT nama, deskripsi, gambar_url FROM tb_apotek";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $obatList[] = $row;
    }
} else {
    echo "<div class='container my-5'><p class='text-center text-muted'>Tidak ada data obat ditemukan.</p></div>";
}
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4 fw-bold">Apotek Online</h1>
            <p class="lead text-muted">Daftar obat yang tersedia di RS Maonise.</p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4">
        <?php if (!empty($obatList)): ?>
            <?php foreach ($obatList as $obat): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm apotek-card" 
                         data-nama="<?php echo htmlspecialchars($obat['nama']); ?>"
                         data-deskripsi="<?php echo htmlspecialchars($obat['deskripsi']); ?>"
                         data-gambar="<?php echo htmlspecialchars($obat['gambar_url']); ?>">
                        
                        <img src="<?php echo htmlspecialchars($obat['gambar_url']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($obat['nama']); ?>" 
                             style="aspect-ratio: 1/1; object-fit: cover;">
                        
                        <div class="card-body text-center">
                            <h5 class="card-title fs-6 fw-bold">
                                <?php echo htmlspecialchars($obat['nama']); ?>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNama"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalGambar" src="" alt="Gambar Obat" class="img-fluid rounded mb-3" style="display: none; max-height: 300px; margin: auto;">
                <p id="modalDeskripsi"></p>
                <hr>
                <p class="mb-0"><strong>Lokasi Apotek Terdekat:</strong></p>
                <p id="modalLokasi" class="text-muted"></p>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    var modalElement = document.getElementById('myModal');
    var myModal = new bootstrap.Modal(modalElement);
    
    var modalNama = document.getElementById('modalNama');
    var modalDeskripsi = document.getElementById('modalDeskripsi');
    var modalGambar = document.getElementById('modalGambar');
    var modalLokasi = document.getElementById('modalLokasi');

    var cards = document.querySelectorAll('.apotek-card');

    function simulasiLokasiApotek() {
        var lokasi = [
            { nama: "Apotek Maonise Utama", jarak: "500m" },
            { nama: "Apotek Maonise Cab. Melati", jarak: "1.2km" },
            { nama: "Apotek Maonise Cab. Anggrek", jarak: "2.5km" }
        ];
        return lokasi[Math.floor(Math.random() * lokasi.length)];
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
            
            myModal.show();
            
            modalLokasi.textContent = "Mencari...";
            setTimeout(function() {
                var lokasiApotek = simulasiLokasiApotek(); 
                modalLokasi.textContent = lokasiApotek.nama + " (sekitar " + lokasiApotek.jarak + ")";
            }, 1000); 
        });
    });
});
</script>


<?php
include 'footer.php';
?>
