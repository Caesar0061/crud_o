<?php include('koneksi.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM produk where id = '$id'";
    $result = mysqli_query($koneksi, $query);
    if(!$result) {
        die("Query Error :".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
    }
    $data = mysqli_fetch_assoc($result);

    if(!count($data)) {
        echo"<script>alert('DATA tidak ditemukan pada tabel.');window.location='index.php;</script>";
    }

} else {
    echo "<script>alert('Masukkan ID yang ingin di edit.');window.location='index.php;</script>";
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title>CRUD M-ONE</title>
        <link rel="stylesheet" type="text/css" href="tambah.css">

        <style type="text/css">
            * {
                font-family: "Trebuchet MS";
            }
            h1 {
                text-transform: uppercase;
                color: blue;
            }
            .base {
                width: 400px;
                padding: 20px;
                margin-left: auto;
                margin-right: auto;
            }
            label {
                margin-top: 10px;
                float: left;
                text-align: left;
                width: 100%;
            }
            input {
                padding: 6px;
                width: 100%;
                box-sizing: border-box;
                background-color: #f8f8f8;
                border: 2px solid #ccc;
                outline-color: salmon;
            }
            button {
                background-color: #87CEFA;
                color: #fff;
                padding: 10px;
                font-size: 12px;
                border: 0;
                margin-top: 20px;
            }
        </style>
</head>
<body>
    <center><h1>Edit Produk <?php echo $data['nama_produk']; ?></h1></center>
    <form method="POST" action="proses_edit.php" enctype="multipart/form-data">
    <section class="base">
        <div>
            <label>Nama Produk</label>
            <input type="text" name=nama_produk" autofocus="" required="" value="<?php echo $data['nama_produk']; ?>" />
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

</div>
<div>
    <label>Deskripsi</label>
    <input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" />
</div>
<div>
    <label>Harga Beli</label>
    <input type="text" name="harga_beli" required="" value="<?php echo $data['harga_beli']; ?>" />
</div>
<div>
    <label>Harga Jual</label>
    <input type="text" name="harga_jual" required="" value="<?php echo $data['harga_jual']; ?>" />
</div>
<div>
    <label>Gambar Produk</label>
    <img src="gambar/<?php echo $data['gambar_produk']; ?>" style="width: 100px;float left;margin_bottom: 5px;">
    <input type="file" name="gambar_produk" />
    <i style="float: left;font-size: 11px;color: red;">Abaikan jika tidak merubah gambar produk</i>
</div>
<div>
    <br>
    <button type="submit">Simpan Perubahan</button>
</div>
</section>
</form>
</body>
</html>