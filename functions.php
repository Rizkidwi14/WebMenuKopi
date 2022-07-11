<?php

//koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "kopi");

if (mysqli_connect_errno()) {
    echo "koneksi database gagal : " . mysqli_connect_error();
}

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//tambah data
function tambah($data)
{
    global $koneksi;

    //Inputan Admin
    $nama = $data["nama"];
    $harga = $data["harga"];
    $keterangan = $data["keterangan"];

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO menu
            VALUES ('','$nama','$keterangan','$harga','$gambar')
            ";
    mysqli_query($koneksi, $query);

    return  mysqli_affected_rows($koneksi);
}
//ubah data
function ubah($data)
{
    global $koneksi;

    $id = $_GET["id"];
    $nama = $data["nama"];
    $harga = $data["harga"];
    $keterangan = $data["keterangan"];
    $fotoLama = $data["fotoLama"];

    //Admin ganti Foto atau tidak
    if ($_FILES["foto"]["error"] === 4) {
        $foto = $fotoLama;
    } else {
        $namaFoto = query("SELECT foto FROM menu WHERE id = '$id' ")[0][0];
        fopen('pictures/menu/' . $namaFoto, 'r+');
        unlink('pictures/menu/' . $namaFoto);

        $foto = upload();
    };

    //query ubah data
    $query = "UPDATE menu SET
                nama = '$nama',
                harga = '$harga',
                keterangan = '$keterangan',
                foto = '$foto'
            WHERE id = $id
            ";
    mysqli_query($koneksi, $query);

    return (mysqli_affected_rows($koneksi));
}

//registrasi
function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $password2 = $data["password2"];

    //cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password != $password2) {
        echo "<script>
                alert('password tidak sama');
            </script>";
        return false;
    }

    //tambahkan user baru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES('$username','$password','user')");
    return mysqli_affected_rows($koneksi);
}

//hapus data
function hapus($id)
{
    global $koneksi;
    $gambar = query("SELECT foto FROM menu WHERE id = $id")[0][0];
    unlink('pictures/menu/' . $gambar);
    mysqli_query($koneksi, "DELETE FROM menu WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}


//upload Foto
function upload()
{
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $tmpName = $_FILES["foto"]["tmp_name"];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu')
            </script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'JPG'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!')
            </script>";
    }

    //cek jika ukuran terlalu besar (maks 2 MB)
    if ($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!')
            </script>";
        return false;
    }

    //lolos pengecekan
    //generate nama gambar baru
    $namaFileBaru = $_POST["nama"];
    $namaFileBaru .= '_';
    $namaFileBaru .= time();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'pictures/menu/' . $namaFileBaru);
    return $namaFileBaru;
}
