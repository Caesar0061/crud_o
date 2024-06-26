<?php include('koneksi.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD M-ONE CHEMICAL</title>
    <link rel="stylesheet" type="text/css" href="index.css">

    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }
        h1 {
            text-transform: uppercase;
            color: blue;
        }
        table {
            border: 1px solid #ddeeee;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto 10px auto;
        }
        table thead th {
            background-color: #ddefef;
            border: 1px solid #ddeeee;
            color: #336b6b;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
        }
        table tbody td {
            border: 1px solid #ddeeee;
            color: #333;
            padding: 10px;
        }
        a {
            background-color: blue;
            color: #fff;
            padding: 10px;
            font-size: 12px;
            text-decoration: none;
        }
        .logout {
    position: absolute; /* Allows positioning relative to the nearest positioned ancestor */
    top: 0; /* Align to the top */
    left: 0; /* Align to the left */
    margin: 10px; /* Optional: Add some margin for spacing */
}

/* Style for the link itself */
.logout a {
    background-color: blue; /* Style the link for better visibility */
    color: #fff; /* White text color */
    padding: 10px; /* Padding around the link text */
    text-decoration: none; /* Remove underline from the link */
    border-radius: 5px; /* Optional: Rounded corners */
}

    </style>
</head>
<body>
    <center><h1>Data Produk</h1></center>
    <center><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a></center>
    <br>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Produk</th>
                <th>Deskripsi</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM produk ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);

            if(!$result) {
                die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
            }
            $no = 1;

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['nama_produk']; ?></td>
                <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
                <td>Rp <?php echo number_format($row['harga_beli'], 0,',','.'); ?></td>
                <td>Rp <?php echo number_format($row['harga_jual'], 0,',','.'); ?></td>
                <td><img style="width: 120px;"src="gambar/<?php echo $row['gambar_produk']; ?>"></td> 
                <td>
                    <a href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda ingin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
                $no++;
            }
            ?>

        </tbody>
    </table>
    <div class="menu">
        <div class="logout">
            <a href="login.php">Logout</a>
        </div>
    </div>
</body>
</html>