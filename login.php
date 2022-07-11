<?php

session_start();

require 'functions.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password' ");

    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        $_SESSION["login"] = true;
        $data = mysqli_fetch_assoc($result);

        //cek jika user login sebagai admin
        if ($data["level"] == "admin") {
            $_SESSION["username"] = $username;
            $_SESSION["level"] = "admin";
        } else if ($data["level"] == "user") {
            $_SESSION["username"] = $username;
            $_SESSION["level"] = "user";
        }
        Header('Location: index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body background="pictures/30100.jpg">
    <div class="boxx">
        <h1>Login</h1>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" autocomplete="off">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="login" value="Login">
        </form>

        <p class="text-light"> Belum mempunyai akun?</p>
        <div class="d-grid gap-2 col-5 mx-auto">
            <button type="button" class="btn btn-outline-primary ">
                <a href="registrasi.php" class="text-decoration-none text-light">Registrasi</a>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>