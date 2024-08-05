<?php
include '../koneksi.php';

if (isset($_POST['input'])) {
    $npm = $_POST['iniid'];
    $nama = $_POST['ininama'];
    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];
    $c4 = $_POST['c4'];
    $hasil = $_POST['hasil'];

    $query = "INSERT INTO tbl_training (id_training,nama_train,c1,c2,c3,c4,hasil) 
    VALUES ('$npm','$nama','$c1','$c2','$c3','$c4','$hasil')";

    if (mysqli_query($konek, $query)) {
        // pesan jika data tersimpan
        echo "<script>alert('Data Berhasil Ditambahkan'); 
    window.location.href='../index.php'</script>";
    } else {
        // pesan jika data gagal disimpan
        echo "<script>alert('Data Gagal Ditambahkan');
    window.location.href='../index.php'</script>";
    }
}
