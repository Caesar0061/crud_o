<?php
include('koneksi.php');

// Retrieve data from POST request
$id = $_POST['id'];
$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$gambar_produk = $_FILES['gambar_produk']['name'];

if ($gambar_produk != "") {
    // Allowed extensions
    $ekstensi_diperbolehkan = array('png', 'jpg');
    $x = explode('.', $gambar_produk);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_produk;

    if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
        // Attempt to move the uploaded file
        if (move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru)) {
            // Prepare the SQL query for update including the image
            $query = "UPDATE produk SET nama_produk = ?, deskripsi = ?, harga_beli = ?, harga_jual = ?, gambar_produk = ? WHERE id = ?";
            $stmt = mysqli_prepare($koneksi, $query);

            if ($stmt) {
                // Bind the parameters
                mysqli_stmt_bind_param($stmt, "ssddsi", $nama_produk, $deskripsi, $harga_beli, $harga_jual, $nama_gambar_baru, $id);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    // If the data is successfully updated
                    echo "<script>alert('Data berhasil diubah!');window.location='index.php';</script>";
                } else {
                    // If the data update fails
                    echo "<script>alert('Data gagal diubah!');window.location='edit_produk.php';</script>";
                }
                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                // If the statement preparation fails
                die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        } else {
            // If file move fails
            echo "<script>alert('Gagal mengunggah gambar!');window.location='edit_produk.php';</script>";
        }
    } else {
        // If the file extension is not allowed
        echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');window.location='edit_produk.php';</script>";
    }
} else {
    // Prepare the SQL query for update without the image
    $query = "UPDATE produk SET nama_produk = ?, deskripsi = ?, harga_beli = ?, harga_jual = ? WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssddi", $nama_produk, $deskripsi, $harga_beli, $harga_jual, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // If the data is successfully updated
            echo "<script>alert('Data berhasil diubah!');window.location='index.php';</script>";
        } else {
            // If the data update fails
            echo "<script>alert('Data gagal diubah!');window.location='edit_produk.php';</script>";
        }
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If the statement preparation fails
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
}
?>
