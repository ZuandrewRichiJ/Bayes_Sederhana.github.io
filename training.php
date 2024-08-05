<?php
include_once 'koneksi.php';
include_once 'function.php';

$c = array("baterai", "kamera", "harga");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <title>Bayes Kategorial</title>
</head>

<body>
    <h1>Naive Bayes Kategorial</h1>
    <br>
    <form action="./index.php" method="post">
        <label for="">HP</label>
        <input type="text" name="hp">
        <label for="">BATERAI</label>
        <select name="baterai" id="">
            <option value="">Pilih</option>
            <option value="Kuat">Kuat</option>
            <option value="Lemah">Lemah</option>
            <option value="Cukup">Cukup</option>
        </select>
        <label for="">Kamera</label>
        <select name="kamera" id="">
            <option value="">Pilih</option>
            <option value="Tinggi">Tinggi</option>
            <option value="Sedang">Sedang</option>
            <option value="Rendah">Rendah</option>
        </select>
        <label for="">harga</label>
        <select name="harga" id="">
            <option value="">Pilih</option>
            <option value="Sangat Murah">Sangat Murah</option>
            <option value="Sangat Mahal">Sangat Mahal</option>
            <option value="Mahal">Mahal</option>
            <option value="Murah">Murah</option>
        </select>
        <button type="submit" name="submit" class="btn btn-primary btn-sm"> Simpan</button>
    </form>


</body>

</html>