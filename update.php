<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama nim
    if (isset($_GET['nim'])) {
        $nim=input($_GET["nim"]);

        $sql="select * from nama where nama=$nama";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peserta=htmlspecialchars($_POST["nim"]);
        $nama=input($_POST["nama"]);
        $sekolah=input($_POST["matakuliah"]);
        $jurusan=input($_POST["jurusan"]);
        $no_hp=input($_POST["no_hp"]);
        $alamat=input($_POST["alamat"]);

        //Query update data pada tabel anggota
        $sql="update peserta set
			nim='$nim',
			nama='$nama',
			matakuliah='$matakuliah',
			jurusan='$jurusan',
			no_hp='$no_hp'
            alamat='$alamat'
			where nim=$nim";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nim:</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukan Nim" required />

        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama " required/>
        </div>
        <div class="form-group">
            <label>Mata_kuliah:</label>
            <input type="text" name="mata_kuliah" class="form-control" placeholder="Masukan mata_kuliah" required/>
        </div>
        <div class="form-group">
            <label>jurusan:</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan jurusan" required/>
        </div>
        <div class="form-group">
            <label>no_hp:</label>
            <textarea name="No_hp" class="form-control" rows="5"placeholder="Maukan no_hp" required/>
        </div>
         <div class="form-group">
            <label>Alamat:</label>
            <textarea name="Alamat" class="form-control" rows="5"placeholder=" Masukan alamat" required></textarea>
        </div>
        <input type="hidden" name="nim" value="<?php echo $data['nim']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>