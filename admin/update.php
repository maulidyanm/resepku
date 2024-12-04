<?php
include '../config.php';

// Daftar kategori yang ingin ditampilkan
$kategoriList = ['Masakan Tradisional', 'Makanan Ringan', 'Dessert', 'Masakan Modern'];
// Ambil ID dari query string
$id = $_GET['edit'];

// Query untuk mendapatkan data resep
$query = "SELECT * FROM resep WHERE id_resep = '$id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $resep = mysqli_fetch_assoc($result);

    // Ambil bahan-bahan
    $queryBahan = "SELECT * FROM tbl_bahan WHERE id_resep = '$id'";
    $resultBahan = mysqli_query($conn, $queryBahan);
    $bahanData = mysqli_fetch_all($resultBahan, MYSQLI_ASSOC);

    // Ambil langkah-langkah
    $queryLangkah = "SELECT * FROM tbl_langkah WHERE id_resep = '$id' ORDER BY urutan ASC";
    $resultLangkah = mysqli_query($conn, $queryLangkah);
    $langkahData = mysqli_fetch_all($resultLangkah, MYSQLI_ASSOC);
} else {
    die("Resep tidak ditemukan.");
}

if (isset($_POST['ubah_resep'])) {
    $nama_resep = $_POST['nama_resep'];
    $nama_pembuat = $_POST['nama_pembuat'];
    $kategori_resep = $_POST['kategori_masakan'];
    $gambar_masakan = $_FILES['gambar_masakan']['name'];
    $gambar_masakan_tmp_name = $_FILES['gambar_masakan']['tmp_name'];
    $gambar_masakan_folder = 'uploadimage/' . $gambar_masakan;
    $deskripsi_resep = $_POST['deskripsi_resep'];
    $porsi_resep = $_POST['porsi_resep'];
    $waktu_masak = $_POST['waktu_masak'];
    $nama_bahan = $_POST['nama_bahan']; // Array
    $jumlah_bahan = $_POST['jumlah_bahan']; // Array
    $langkah = $_POST['langkah']; // Array

    // Update gambar jika ada file baru
    if (!empty($gambar_masakan)) {
        move_uploaded_file($gambar_masakan_tmp_name, $gambar_masakan_folder);
    } else {
        $gambar_masakan = $resep['gambar'];
    }

    // Update data resep
    $queryUpdateResep = "UPDATE resep SET 
                            nama_resep = '$nama_resep', 
                            nama_pembuat = '$nama_pembuat', 
                            kategori = '$kategori_resep',
                            deskripsi = '$deskripsi_resep', 
                            porsi = '$porsi_resep', 
                            waktu_memasak = '$waktu_masak', 
                            gambar = '$gambar_masakan'
                         WHERE id_resep = '$id'";

    if (mysqli_query($conn, $queryUpdateResep)) {
        // Hapus data lama di tabel bahan dan langkah
        mysqli_query($conn, "DELETE FROM tbl_bahan WHERE id_resep = '$id'");
        mysqli_query($conn, "DELETE FROM tbl_langkah WHERE id_resep = '$id'");

        // Masukkan data baru untuk tabel bahan
        foreach ($nama_bahan as $key => $value) {
            $bahan = $value;
            $jumlah = $jumlah_bahan[$key];
            $queryBahan = "INSERT INTO tbl_bahan (id_resep, nama_bahan, jumlah) 
                           VALUES ('$id', '$bahan', '$jumlah')";
            mysqli_query($conn, $queryBahan);
        }

        // Masukkan data baru untuk tabel langkah
        foreach ($langkah as $urutan => $value) {
            $urutan_langkah = $urutan + 1;
            $detail_langkah = $value;
            $queryLangkah = "INSERT INTO tbl_langkah (id_resep, urutan, langkah) 
                             VALUES ('$id', '$urutan_langkah', '$detail_langkah')";
            mysqli_query($conn, $queryLangkah);
        }

        $message[] = 'Resep berhasil diperbarui!';
    } else {
        $message[] = 'Gagal memperbarui resep!';
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Resep</title>

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
        <h3>Ubah resepmu di sini!</h3>
        <input type="text" placeholder="Nama Resep" name="nama_resep" class="box" value="<?= $resep['nama_resep'] ?>">
        <input type="text" placeholder="Nama Pembuat" name="nama_pembuat" class="box" value="<?= $resep['nama_pembuat'] ?>">
        <h4>Kategori Masakan</h4>
        <select name="kategori_masakan" class="box">
            <?php foreach ($kategoriList as $kategori): ?>
                <option value="<?= $kategori ?>" <?php if ($resep['kategori'] == $kategori) echo 'selected'; ?>>
                    <?= $kategori ?>
                </option>
            <?php endforeach; ?>
        </select>
        <h4>Foto Hasil Masakan</h4>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="gambar_masakan" class="box">
        <p>Gambar sebelumnya: <?= $resep['gambar'] ?></p>
        <input type="text" placeholder="Contoh: 5 Porsi" name="porsi_resep" class="box" value="<?= $resep['porsi'] ?>">
        <textarea name="deskripsi_resep" placeholder="Deskripsi Masakan" class="box description"><?= $resep['deskripsi'] ?></textarea>
        <h4>Waktu Memasak</h4>
        <input type="text" placeholder="1 Jam 15 Menit" name="waktu_masak" class="box" value="<?= $resep['waktu_memasak'] ?>">
        <h4>Bahan-bahan</h4>
        <div class="form-group bahan-bahan">
            <?php foreach ($bahanData as $bahan): ?>
            <div class="bahan-item">
                <div class="input-wrapper">
                    <input type="text" placeholder="Nama Bahan (Contoh: Tepung Terigu)" name="nama_bahan[]" class="box" value="<?= $bahan['nama_bahan'] ?>">
                </div>
                <div class="input-wrapper">
                    <input type="text" placeholder="Jumlah (contoh: 200 gram)" name="jumlah_bahan[]" class="box" value="<?= $bahan['jumlah'] ?>">
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="button" id="tambah-bahan" class="btn">+ Bahan</button>


        <h4>Langkah-langkah</h4>
        <div class="form-group langkah-langkah">
            <?php foreach ($langkahData as $langkah): ?>
            <div class="circle"><?= $langkah['urutan'] ?></div>
            <input type="text" placeholder="Langkah ke-<?= $langkah['urutan'] ?>" name="langkah[]" class="box" value="<?= $langkah['langkah'] ?>">
            <?php endforeach; ?>
        </div>
        <button type="button" id="tambah-langkah" class="btn">+ Langkah</button>
        <div class="button-wrapper">
            <input type="submit" class="btn" name="ubah_resep" value="Ubah Resep">
        </div>
        <div class="button-wrapper">
            <a href="data-resep.php" class="btn">Kembali</a>
        </div>
    </form>


</div>

</div>
    



/*JS*/
<script>  

$(document).ready(function () {
    $('#tambah-bahan').click(function () {
        // Klon elemen bahan-item pertama
        var bahanItem = $('.bahan-item').first().clone();

        // Kosongkan nilai input
        bahanItem.find('input').val('');

        // Tambahkan elemen baru setelah elemen terakhir
        $('.bahan-bahan').append(bahanItem);
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