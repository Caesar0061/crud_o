<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "crud_gc";
$koneksi = mysqli_connect($host,$user,$pass,$db);

if(!$koneksi) {
    die("koneksi dengan database gagal: ".mysql_connect_error());
} 
?>