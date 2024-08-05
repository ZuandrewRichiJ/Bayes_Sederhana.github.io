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
    <div class="container mt-3">
        <h1>Naive Bayes Kategorial</h1>
        <br>
        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">input kasus</a>
        <a href="./training.php">ADD</a>
        <div class="row">
            <div class="col">
                <?php
                if (isset($_POST["submit"])) {
                    $hp = $_POST['hp'];
                    $baterai = $_POST['baterai'];
                    $kamera = $_POST['kamera'];
                    $harga = $_POST['harga'];
                ?>
                    <br>
                    <h4>DATA KASUS TERBARU</h4>
                    <table border="5" class="table table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Handphone</th>
                                <th>Baterai</th>
                                <th>Kamera</th>
                                <th>harga</th>
                                <th>Layak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $hp ?></td>
                                <td><?= $baterai ?></td>
                                <td><?= $kamera ?></td>
                                <td><?= $harga ?></td>
                                <td>?</td>
                                <!-- <td><?= $layak ?></td> -->
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
                <h4>DATA NAIVE BAYESIAN KATEGORIAL</h4>
                <table border="5" class="table table-hover">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Handphone</th>
                            <th>Baterai</th>
                            <th>Kamera</th>
                            <th>harga</th>
                            <th>Layak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (data() as $data) { ?>
                            <tr>
                                <td><?= $data['hp'] ?></td>
                                <td><?= $data['baterai'] ?></td>
                                <td><?= $data['kamera'] ?></td>
                                <td><?= $data['harga'] ?></td>
                                <td><?= $data['layak'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <h4>PROBABILITAS LAYAK</h4>
                <table border="5" class="table table-hover">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th scope="col" rowspan="2" class="align-middle text-center">LAYAK</th>
                            <th scope="col" colspan="2" class="text-center">Jumlah Kejadian</th>
                            <th scope="col" colspan="2" class="text-center">Probabilitas</th>
                        </tr>
                        <tr>
                            <th>Ya</th>
                            <th>Tidak</th>
                            <th>Ya</th>
                            <th>Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Probabilitas Layak</td>
                            <td><?= layak('Ya') ?></td>
                            <td><?= layak('Tidak') ?></td>
                            <?php
                            // $layakYa = 8 / (8+6)
                            $layakYa = layak('Ya') / (layak('ya') + layak('Tidak'));
                            $layakTidak = layak('Tidak') / (layak('ya') + layak('Tidak'));
                            $layakYa = number_format($layakYa, 4, '.', '');
                            $layakTidak = number_format($layakTidak, 4, '.', '');
                            ?>
                            <td><?= $layakYa ?></td>
                            <td><?= $layakTidak ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php foreach ($c as $c) { ?>
                    <br>
                    <!-- BATERAI, KAMERA, HARGA -->
                    <h4>PROBABILITAS <?= strtoupper($c) ?></h4>
                    <table border="5" class="table table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th scope="col" rowspan="2" class="align-middle text-center"><?= strtoupper($c) ?></th>
                                <th scope="col" colspan="2" class="text-center">Jumlah Kejadian</th>
                                <th scope="col" colspan="2" class="text-center">Probabilitas</th>
                            </tr>
                            <tr>
                                <th>Ya</th>
                                <th>Tidak</th>
                                <th>Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ya = 0;
                            $tidak = 0;
                            foreach (c($c) as $nilai) { ?>
                                <tr>
                                    <td><?= $nilai[$c] ?></td>
                                    <!-- jumlah kejadian -->
                                    <td><?= hitung($c, $nilai[$c], 'Ya') ?></td>
                                    <td><?= hitung($c, $nilai[$c], 'Tidak') ?></td>
                                    <!-- probabilitas -->
                                    <td><?= hitung($c, $nilai[$c], 'Ya') / layak('Ya') ?></td>
                                    <td><?= hitung($c, $nilai[$c], 'Tidak') / layak('Tidak') ?></td>
                                </tr>
                            <?php
                                // menghitung total probabilitas, total = 1
                                $ya = $ya + (hitung($c, $nilai[$c], 'Ya') / layak('Ya'));
                                $tidak = $tidak + (hitung($c, $nilai[$c], 'Tidak') / layak('Tidak'));
                            } ?>
                            <tr>
                                <td><b>Jumlah</b></td>
                                <td><?= layak('Ya') ?></td>
                                <td><?= layak('Tidak') ?></td>
                                <td><?= $ya ?></td>
                                <td><?= $tidak ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
                <hr>
                <?php
                if (isset($_POST["submit"])) { ?>
                    <h4>DATA KASUS TERBARU</h4>
                    <table border="5" class="table table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th rowspan="2" class="align-middle text-center">Handphone (<?= $hp ?>)</th>
                                <th colspan="2">Baterai (<?= $baterai ?>)</th>
                                <th colspan="2">Kamera (<?= $kamera ?>)</th>
                                <th colspan="2">Harga (<?= $harga ?>)</th>
                                <th colspan="2">Layak</th>
                            </tr>
                            <tr>
                                <th>Ya</th>
                                <th>Tidak</th>
                                <th>Ya</th>
                                <th>Tidak</th>
                                <th>Ya</th>
                                <th>Tidak</th>
                                <th>Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Probabilitas</td>
                                <td><?= hitung('baterai', $baterai, 'Ya') / layak('Ya') ?></td>
                                <td><?= hitung('baterai', $baterai, 'Tidak') / layak('Tidak') ?></td>

                                <td><?= hitung('kamera', $kamera, 'Ya') / layak('Ya') ?></td>
                                <td><?= hitung('kamera', $kamera, 'Tidak') / layak('Tidak') ?></td>

                                <td><?= hitung('harga', $harga, 'Ya') / layak('Ya') ?></td>
                                <td><?= hitung('harga', $harga, 'Tidak') / layak('Tidak') ?></td>

                                <td><?= $layakYa ?></td>
                                <td><?= $layakTidak ?></td>
                            </tr>
                            <?php
                            $hasilYa_new = (hitung('baterai', $baterai, 'Ya') / layak('Ya')) *
                                (hitung('kamera', $kamera, 'Ya') / layak('Ya')) * (hitung('harga', $harga, 'Ya') / layak('Ya'));
                            $hasilYa_new = number_format($hasilYa_new, 4, '.', '');
                            $hasilYa = $hasilYa_new * $layakYa;
                            // $hasilYa = 0.0175 * $layakYa;

                            $hasilTidak = (hitung('baterai', $baterai, 'Tidak') / layak('Tidak')) *
                                (hitung('kamera', $kamera, 'Tidak') / layak('Tidak')) * (hitung('harga', $harga, 'Tidak') / layak('Tidak'));
                            $hasilTidak = number_format($hasilTidak, 4, '.', '');
                            $hasilTidak = $hasilTidak * $layakTidak;

                            // mengambil nilai terbesar
                            if ($hasilTidak > $hasilYa) {
                                $layak = 'Tidak';
                            } else {
                                $layak = 'Ya';
                            }
                            ?>

                            <!-- menampilkan perhitungan kasus terbaru -->
                            <tr>
                                <td>Ya</td>
                                <td colspan="8"><?= hitung('baterai', $baterai, 'Ya') / layak('Ya') . ' * ' .
                                                    hitung('kamera', $kamera, 'Ya') / layak('Ya') . ' * ' .
                                                    hitung('harga', $harga, 'Ya') / layak('Ya') . ' * '  . $layakYa . ' = <b>' . $hasilYa . '</b>' ?></td>
                            </tr>
                            <tr>
                                <td>Tidak</td>
                                <td colspan="8"><?= hitung('baterai', $baterai, 'Tidak') / layak('Tidak') . ' * ' .
                                                    hitung('kamera', $kamera, 'Tidak') / layak('Tidak') . ' * ' .
                                                    hitung('harga', $harga, 'Tidak') / layak('Tidak') . ' * '  . $layakTidak . ' = <b>' . $hasilTidak . '</b>' ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h4>KESIMPUILAN KASUS TERBARU</h4>
                    <table border="5" class="table table-hover mb-5">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Handphone</th>
                                <th>Baterai</th>
                                <th>Kamera</th>
                                <th>harga</th>
                                <th>Layak Direkomendasikan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $hp ?></td>
                                <td><?= $baterai ?></td>
                                <td><?= $kamera ?></td>
                                <td><?= $harga ?></td>
                                <td><?= $layak ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="index.php" role="button" title="Lihat Detail User">Tambah</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                    mysqli_query($konek, "INSERT INTO tbl_training (hp,baterai,kamera,harga, layak) VALUES ('$hp','$baterai','$kamera','$harga','$layak')");
                } ?>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php $c = array("baterai", "kamera", "harga"); ?>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">HP</label>
                                <input type="text" name="hp">
                            </div>
                            <?php foreach ($c as $c) { ?>
                                <div class="form-group row">
                                    <label for="<?= $c ?>" class="col-sm-2 col-form-label"><?= strtoupper($c) ?></label>
                                    <div class="col-sm-18">
                                        <select name="<?= $c ?>" id="<?= $c ?>" class="form-control">
                                            <option value="">Pilih <?= strtoupper($c) ?></option>
                                            <?php foreach (c($c) as $nilai) { ?>
                                                <option value="<?= $nilai[$c] ?>"><?= $nilai[$c] ?></option><br>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <hr>
                                </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-18">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm"> Simpan</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Input -->

    </div>

</body>

</html>