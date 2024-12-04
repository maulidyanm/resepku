<?php
   include '../config.php';

   if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_autocommit($conn, FALSE); // Start transaction

    $delete_resep = mysqli_query($conn, "DELETE FROM resep WHERE id_resep = $id");
    $delete_bahan = mysqli_query($conn, "DELETE FROM tbl_bahan WHERE id_resep = $id");
    $delete_langkah = mysqli_query($conn, "DELETE FROM tbl_langkah WHERE id_resep = $id");

    if ($delete_resep && $delete_bahan && $delete_langkah) {
        mysqli_commit($conn);
        header('location:data-resep.php'); // Redirect on success
    } else {
        mysqli_rollback($conn);
        echo "Error deleting recipe!"; // Handle errors appropriately
    }

    mysqli_autocommit($conn, TRUE); // End transaction (optional)
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- font awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
     <link rel="stylesheet" href="../css/form.css">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php
    $sql = "SELECT r.id_resep, r.nama_resep, r.kategori, r.gambar, r.deskripsi, r.porsi, r.waktu_memasak, " .
    "GROUP_CONCAT(DISTINCT b.nama_bahan ORDER BY br.id_bahan SEPARATOR ', ') AS nama_bahan, " .
    "GROUP_CONCAT(DISTINCT br.jumlah ORDER BY br.id_bahan SEPARATOR ', ') AS jumlah_bahan, " .
    "GROUP_CONCAT(DISTINCT l.langkah ORDER BY l.id_langkah SEPARATOR '. ') AS langkah " .
    "FROM resep r " .
    "INNER JOIN tbl_bahan br ON r.id_resep = br.id_resep " .
    "INNER JOIN tbl_bahan b ON br.id_bahan = b.id_bahan " .
    "INNER JOIN tbl_langkah l ON r.id_resep = l.id_resep " .
    "GROUP BY r.id_resep;";

    $result = mysqli_query($conn, $sql);
?>
   
<div class="container">
    <div class="button-wrapper" style="display: flex; justify-content: flex-start;">
        <a href="add.php" class="btn">+ Resep</a>
    </div>

    <div class="product-display">
        
    <table class="product-display-table">
        <thead>
            <tr>
                <th>Nama Resep</th>
                <th>Kategori Masakan</th>
                <th>Gambar</th>
                <th>Deskripsi Resep</th>
                <th>Porsi</th>
                <th>Waktu Memasak</th>
                <th>Bahan</th>
                <th>Jumlah</th>
                <th>Langkah</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['nama_resep']; ?></td>
                <td><?php echo $row['kategori']; ?></td>
                <td><img src="../uploadimage/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
                <td><?php echo $row['deskripsi']; ?></td>
                <td><?php echo $row['porsi']; ?></td>
                <td><?php echo $row['waktu_memasak']; ?></td>
                <td><?php echo $row['nama_bahan']; ?></td>
                <td><?php echo $row['jumlah_bahan']; ?></td>
                <td><?php echo $row['langkah']; ?></td>
                <td>
                    <a href="update.php?edit=<?php echo $row['id_resep']; ?>" class="btn-action"> <i class="fas fa-edit"></i>Edit</a>
                    <a href="#" class="btn-action delete-recipe" data-id="<?php echo $row['id_resep']; ?>"> <i class="fas fa-trash"></i>Delete</a>
                </td>
            </tr>
                <?php } ?>

                <script>
                $(document).ready(function() {
                    $('.delete-recipe').click(function(e) {
                    e.preventDefault(); // Prevent default link behavior

                    var id = $(this).data('id'); // Get recipe ID from data attribute

                    if (confirm('Apakah Anda yakin ingin menghapus resep ini?')) {
                        window.location.href = "profile.php?delete=" + id; // Redirect to delete action
                    }
                    });
                });
                </script>
    </table>
</div> 
</div>
  

</body>
</html>