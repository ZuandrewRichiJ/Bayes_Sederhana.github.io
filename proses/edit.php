<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <?php
    include '../koneksi.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // ambil data berdasarkan npm		 
        $stid = mysqli_query($konek, "SELECT * FROM t_mahasiswa WHERE npm = '$id'");

        while ($d = mysqli_fetch_array($stid)) {
            $dataprodi = explode(',', $d['program_studi']);

    ?>
    <form action="" method="post">
        <label for="">npm : </label>
        <input type="number" name="ininpm" value="<?= $d['npm'] ?>"><br>
        <label for="">nama : </label>
        <input type="text" name="ininama" value="<?= $d['nama'] ?>"><br>
        <label for="">Tanggal Lahir : </label>
        <input type="date" name="initanggal" value="<?= $d['tanggal'] ?>"><br>
        <label for="">Jenis Kelamin : </label><br>
        <input type="radio" name="inikelamin<?= $d['kelamin'] ?>" checked="checked" value="Laki-Laki"> LAKI - LAKI <br>
        <input type="radio" name="inikelamin<?= $d['kelamin'] ?>" value="Perempuan"> PEREMPUAN <br>
        <label for="">Agama : </label>
        <select name="iniagama" value="<?= $d['agama'] ?>">
            <option value="ISLAM">ISLAM</option>
            <option value="KRISTEN">KRISTEN</option>
            <option value="KHATOLIK">KHATOLIK</option>
            <option value="HINDU">HINDU</option>
            <option value="BUDHA">BUDHA</option>
        </select><br>
        <label for="">email : </label>
        <input type="text" name="iniemail" value="<?= $d['email'] ?>"><br>
        <label for="">Program Studi : </label><br>
        <label><input type="checkbox" name="list[]" value="Teknik Sipil"
                <?php if (in_array("Teknik Sipil", $dataprodi)) echo "checked"; ?>>Teknik Sipil</label><br>
        <label><input type="checkbox" name="list[]" value="Teknik Perminyakan"
                <?php if (in_array("Teknik Perminyakan", $dataprodi)) echo "checked"; ?>>Teknik Perminyakan</label><br>
        <label><input type="checkbox" name="list[]" value="Teknik Mesin"
                <?php if (in_array("Teknik Mesin", $dataprodi)) echo "checked"; ?>>Teknik Mesin</label><br>
        <label><input type="checkbox" name="list[]" value="Teknik Geologi"
                <?php if (in_array("Teknik Geologi", $dataprodi)) echo "checked"; ?>>Teknik Geologi</label><br>
        <label><input type="checkbox" name="list[]" value="Teknik Informatika"
                <?php if (in_array("Teknik Informatika", $dataprodi)) echo "checked"; ?>>Teknik Informatika</label><br>

        <input type="submit" value="Edit" name="input">
        <br>
        <hr>
    </form>
    <?php
        }
    }
    ?>
</body>

</html>
<?php
if (isset($_POST['input'])) {
    $npm = $_POST['ininpm'];
    $nama = $_POST['ininama'];
    $tgl = $_POST['initanggal'];
    $jk = $_POST['inikelamin'];
    $agama = $_POST['iniagama'];
    $email = $_POST['iniemail'];
    $prodi = implode(",", $_POST['list']);

    $query = "UPDATE t_mahasiswa SET nama='$nama',tanggal='$tgl',kelamin='$jk',
    agama='$agama',email='$email',program_studi='$prodi' WHERE npm='$npm'";

    if (mysqli_query($konek, $query)) {
        // pesan jika data tersimpan
        echo "<script>alert('Data Berhasil Diedit'); 
        window.location.href='../index.php'</script>";
    } else {
        // pesan jika data gagal disimpan
        echo "<script>alert('Data Gagal Diedit');
        window.location.href='../index.php'</script>";
    }
}
?>