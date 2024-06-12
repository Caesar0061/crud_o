<?php
session_start();

// Memanggil atau membutuhkan file koneksi.php
require 'koneksi.php';

$errorMessage = '';

// Jika form register dikirim
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password dienkripsi menggunakan md5
    $email = $_POST['email'];
    $created_at = date('Y-m-d H:i:s'); // Format tanggal dan waktu

    // Validasi input kosong
    if (empty($username) || empty($password) || empty($email)) {
        $errorMessage = "Username, Password, dan Email tidak boleh kosong!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Format email tidak valid!";
    } else {
        // Query untuk menambahkan user baru
        $query = "INSERT INTO register (username, password, email, created_at) VALUES ('$username', '$password', '$email', '$created_at')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Register berhasil! Silakan login.');</script>";
            header('location:login.php');
            exit;
        } else {
            // Tangani jika ada error dari query SQL, contoh: duplikat username atau email
            $errorMessage = "Gagal mendaftar. Username atau Email mungkin sudah digunakan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/login.css">

    <title>Register | M-ONE | CHEMICAL</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/bg/memphis-colorful.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .register-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn {
            width: 100%;
        }
        .login-register-text {
            margin: 15px 0;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h4 class="fw-bold">Register</h4>
        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Masukkan Username" name="username" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Masukkan Password" name="password" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Masukkan Email" name="email" autocomplete="off" required>
            </div>
            <p class="login-register-text">Sudah punya akun? <a href="login.php">Login Here</a>.</p>
            <button class="btn btn-primary text-uppercase" type="submit" name="register">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
