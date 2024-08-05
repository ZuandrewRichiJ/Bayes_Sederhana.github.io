<?php
//koneksi database
include '../koneksi.php';

//menangkap data id yang dikirim dari url
$id = $_GET['id'];

//menghapus data dari database
mysqli_query($konek, "DELETE FROM t_mahasiswa WHERE npm = '$id'");

//mengalihkan halaman kembali ke index
header("location:../index.php?msg=deleted");