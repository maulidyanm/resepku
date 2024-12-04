<?php

include '../config.php';

if (isset($_POST['tambah_resep'])) {
    $nama_resep = $_POST['nama_resep'];
    $nama_pembuat = $_POST['nama_pembuat'];
    $kategori_masakan = $_POST['kategori_masakan'];
    $gambar_masakan = $_FILES['gambar_masakan']['name'];
    $gambar_masakan_tmp_name = $_FILES['gambar_masakan']['tmp_name'];
    $gambar_masakan_folder = '../uploadimage/' . $gambar_masakan;
    $deskripsi_resep = $_POST['deskripsi_resep'];
    $porsi_resep = $_POST['porsi_resep'];
    $waktu_masak = $_POST['waktu_masak'];
    $nama_bahan = $_POST['nama_bahan']; // Array
    $jumlah_bahan = $_POST['jumlah_bahan']; // Array
    $langkah = $_POST['langkah']; // Array

    if (empty($nama_resep) || empty($nama_pembuat) || empty($kategori_masakan) || empty($gambar_masakan) || empty($porsi_resep) || empty($deskripsi_resep) || empty($waktu_masak) || empty($nama_bahan) || empty($jumlah_bahan) || empty($langkah)) {
        $message[] = 'Mohon isi semua kolom';
    } else {
        // Upload gambar
        if (move_uploaded_file($gambar_masakan_tmp_name, $gambar_masakan_folder)) {
            // Query untuk tabel resep
            $queryResep = "INSERT INTO resep (nama_resep, nama_pembuat, deskripsi, porsi, waktu_memasak, gambar, waktu_dibuat, kategori) 
              VALUES ('$nama_resep', '$nama_pembuat', '$deskripsi_resep', '$porsi_resep', '$waktu_masak', '$gambar_masakan', NOW(), '$kategori_masakan')";

            if (mysqli_query($conn, $queryResep)) {
                // Ambil ID resep yang baru ditambahkan
                $id_resep = mysqli_insert_id($conn);

                // Query untuk tabel tbl_bahan
                foreach ($nama_bahan as $key => $value) {
                    $bahan = $value;
                    $jumlah = $jumlah_bahan[$key];
                    $queryBahan = "INSERT INTO tbl_bahan (id_resep, nama_bahan, jumlah) 
                                   VALUES ('$id_resep', '$bahan', '$jumlah')";
                    mysqli_query($conn, $queryBahan);
                }

                // Query untuk tabel tbl_langkah
                foreach ($langkah as $urutan => $value) {
                    $urutan_langkah = $urutan + 1; // Mulai dari 1
                    $detail_langkah = $value;
                    $queryLangkah = "INSERT INTO tbl_langkah (id_resep, urutan, langkah) 
                                     VALUES ('$id_resep', '$urutan_langkah', '$detail_langkah')";
                    mysqli_query($conn, $queryLangkah);
                }

                $message[] = 'Resep berhasil ditambahkan!';
            } else {
                $message[] = 'Gagal menambahkan resep!';
            }
        } else {
            $message[] = 'Gagal mengupload gambar!';
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
    <!-- font awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>


<div class="container">

   <div class="admin-product-form-container">

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Tambahkan resepmu di sini!</h3>
            <input type="text" placeholder="Nama Resep" name="nama_resep" class="box">
            <input type="text" placeholder="Nama Pembuat" name="nama_pembuat" class="box">
            <h4>Kategori Masakan</h4>
            <select name="kategori_masakan" class="box">
                <option value="Masakan Tradisional">Masakan Tradisional</option>
                <option value="Makanan Ringan">Makanan Ringan</option>
                <option value="Makanan Berat">Dessert</option>
                <option value="Modern">Masakan Modern</option>
            </select>
            <h4>Foto Hasil Masakan</h4>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="gambar_masakan" class="box">
            <input type="text" placeholder="Contoh: 5 Porsi" name="porsi_resep" class="box">
            <textarea name="deskripsi_resep" placeholder="Deskripsi Masakan" class="box description"></textarea> 
            <h4>Waktu Memasak</h4>
            <input type="text" placeholder="1 Jam 15 Menit" name="waktu_masak" class="box">
            <h4>Bahan-bahan</h4>
            <div class="form-group bahan-bahan">
                <div class="bahan-item">
                    <div class="input-wrapper">
                        <input type="text" placeholder="Nama Bahan (Contoh: Tepung Terigu)" name="nama_bahan[]" class="box">
                    </div>
                    <div class="input-wrapper">
                        <input type="text" placeholder="Jumlah (contoh: 200 gram)" name="jumlah_bahan[]" class="box">
                    </div>
                </div>
            </div>
            <button type="button" id="tambah-bahan" class="btn">+ Bahan</button>
            <h4>Langkah-langkah</h4>
            <div class="form-group langkah-langkah">
            <div class="circle">1</div>
            <input type="text" placeholder="Langkah ke-1 (contoh: Panaskan minyak...)" name="langkah[]" class="box">
            </div>
            <div class="form-group langkah-langkah">
            <div class="circle">2</div>
            <input type="text" placeholder="Langkah ke-2 (contoh: Masukkan bawang...)" name="langkah[]" class="box">
            </div>
            <button type="button" id="tambah-langkah" class="btn">+ Langkah</button>
            
            <div class="button-wrapper">
            <input type="submit" class="btn" name="tambah_resep" value="Tambah Resep">
            </div>

        </form>

   </div>
</div>
    











/* JS */
<script>  

$(document).ready(function() {
    // Tambahkan bahan
    $('#tambah-bahan').click(function() {
        var bahanGroup = $('.bahan-bahan').first().clone();
        bahanGroup.find('input').val(''); // Bersihkan nilai input
        $('.bahan-bahan:last').after(bahanGroup); // Tambahkan setelah elemen terakhir
    });

    let langkahCounter = 1;

    $('#tambah-langkah').click(function() {
        // Temukan semua elemen .circle dan ambil nilai terbesar
        let lastCircle = $('.langkah-langkah .circle:last');
        let lastNumber = parseInt(lastCircle.text());

        if (isNaN(lastNumber)) {
            lastNumber = 0;
        }

        langkahCounter = lastNumber + 1;

        // Klon elemen langkah dan perbarui nomor dan placeholder
        var langkahGroup = $('.langkah-langkah').first().clone();
        langkahGroup.find('.circle').text(langkahCounter);
        langkahGroup.find('input').attr('placeholder', 'Langkah ke-' + langkahCounter + ' (contoh: Tuangkan...)');
        $('.langkah-langkah:last').after(langkahGroup);
    });
});

$(document).ready(function() {
    <?php if(isset($message)): ?>
        <?php foreach($message as $message): ?>
            alert("<?php echo $message; ?>");
        <?php endforeach; ?>
    <?php endif; ?>
});

</script>


</body>
</html>