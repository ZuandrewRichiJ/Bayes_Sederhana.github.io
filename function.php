<?php
include 'koneksi.php';

function c($c)
{
    global $konek;
    $query = "SELECT DISTINCT $c FROM tbl_training";
    $result = mysqli_query($konek, $query);
    $rows = [];
    while ($baris = mysqli_fetch_assoc($result)) {
        $rows[] = $baris;
    }
    return $rows;
}

function data()
{
    global $konek;
    $query = "SELECT * FROM tbl_training ORDER BY hp";
    $result = mysqli_query($konek, $query);
    $rows = [];
    while ($baris = mysqli_fetch_assoc($result)) {
        $rows[] = $baris;
    }
    return $rows;
}

//$c = batrai, kamera, harga; $nilai=isi value nya seperti kuat, lemah, cukup, dll; $layak = ya dan tidak
function hitung($c, $nilai, $layak)
{
    global $konek;
    $query = "SELECT COUNT($c) FROM tbl_training WHERE $c = '$nilai' AND layak = '$layak'";
    $res = mysqli_query($konek, $query);
    $result = mysqli_fetch_row($res);
    return $result[0];
}

function layak($layak)
{
    global $konek;
    $query = "SELECT COUNT(layak) FROM tbl_training WHERE layak = '$layak'";
    $res = mysqli_query($konek, $query);
    $result = mysqli_fetch_row($res);
    return $result[0];
}
