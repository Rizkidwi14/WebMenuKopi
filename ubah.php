<?php

session_start();

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}


require 'functions.php';
$id = $_GET["id"];
$menu = query("SELECT * FROM menu WHERE id = $id")[0];

if (isset($_POST["submit"])) {
  if (ubah($_POST) > -1) {
    echo "<script>
                alert ('Data Berhasil Diubah');
                document.location.href = 'admin.php';
            </script>
            ";
  } else {
    echo ("Error Description: " . $koneksi->error);
  }
}
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

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
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
              <a class="nav-link active" aria-current="page" href="admin.php">
                <span data-feather="home"></span>
                Dashboard Admin
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-10 ms-sm-auto px-md-4">
        <h1>Ubah Data Minuman</h1>
        <div class="text-dark bg-light col-md-4">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="fotoLama" value="<?= $menu["foto"]; ?>">
            <div class="mb-2">
              <label for="nama" class="form-label">Nama Minuman</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $menu["nama"]; ?>" required>
            </div>
            <div class="mb-2">
              <label for="harga" class="form-label">Harga</label>
              <input type="text" class="form-control" id="harga" name="harga" value="<?= $menu["harga"]; ?>" required>
            </div>
            <div class="mb-2">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea class="form-control" name="keterangan"><?= $menu["keterangan"]; ?></textarea>
            </div>
            <div class="mb-2">
              <label for="foto" class="form-label">Foto</label>
              <input type="file" class="form-control" name="foto" id="foto">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
          </form>
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