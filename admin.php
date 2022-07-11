<?php

session_start();

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}


require 'functions.php';
$menu = query("SELECT * FROM menu");

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.79.0">
  <title>Dashboard Admin</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="">Dashboard Admin</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Sign Out</a>
      </li>
    </ul>
  </header>

  <!-- Navbar -->
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">
                <span data-feather="home"></span>
                Kembali Ke Halaman Utama
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">



        <h2>Data Minuman</h2>
        <a class="btn btn-primary" href="tambah.php" role="button">Tambah Data Minuman</a>
        <div class="table-responsive">

          <table class="table table-striped table-sm align-middle text-center">
            <thead>
              <th>NO.</th>
              <th>Gambar</th>
              <th>Nama Minuman</th>
              <th>Keterangan</th>
              <th>Harga</th>
              <th></th>
            </thead>

            <?php $i = 1; ?>
            <?php foreach ($menu as $row) : ?>
              <tr>
                <td> <?= $i; ?> </td>
                <td> <img src="pictures/menu/<?= $row["foto"]; ?>" width="100px" height="100px"></td>
                <td> <?= $row["nama"] ?> </td>
                <td> <?= $row["keterangan"] ?> </td>
                <td>Rp. <?= number_format($row["harga"], 0, ",", "."); ?> </td>
                <td>
                  <a class="btn btn-warning btn-sm" href="ubah.php?id=<?= $row["id"]; ?>" role="button">Ubah</a>
                  |
                  <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data?')" href="hapus.php?id=<?= $row["id"]; ?>" role="button">Hapus</a>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </table>


        </div>
      </main>
    </div>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>