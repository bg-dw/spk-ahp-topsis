<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</div>
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title text-white">Perhitungan</h3>
                <button class="btn btn-info ml-auto" onclick="detail();">Detail</button>
            </div>
            <div class="card-body" id="perhitungan" style="display: none;">
                <h3>1. Nilai</h3>
                <div style=" overflow-x: auto;">
                    <table class="table datatables table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No.</th>
                                <th style="text-align: center;">Alternatif</th>
                                <?php for ($i = 0; $i < count($kt); $i++) : ?>
                                    <th style="text-align: center;"><?= $kt[$i] ?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($id_alt); $i++) : ?>
                                <tr>
                                    <td align="center"><?= ($i + 1) . "."; ?></td>
                                    <td align="center"><?= $alt[$i]; ?></td>
                                    <?php for ($j = 0; $j < count($kt); $j++) : ?>
                                        <td align="center"><?= $nilai[$i][$j] ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3>2. Pembagi</h3>
                <div style=" overflow-x: auto;">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <tr>
                            <th style="vertical-align: middle;" rowspan="2">Pembagi</th>
                            <?php for ($i = 0; $i < count($kt); $i++) : ?>
                                <th style="text-align: center;"><?= $kt[$i] ?></th>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <?php for ($i = 0; $i < count($pembagi); $i++) : ?>
                                <td style="text-align: center;"><?= $pembagi[$i] ?></td>
                            <?php endfor; ?>
                        </tr>
                    </table>
                </div>
                <hr>
                <h3>3. Matriks Ternormalisasi</h3>
                <div style=" overflow-x: auto;">
                    <table class="table datatables table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No.</th>
                                <th style="text-align: center;">Alternatif</th>
                                <?php for ($i = 0; $i < count($kt); $i++) : ?>
                                    <th style="text-align: center;"><?= $kt[$i] ?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($id_alt); $i++) : ?>
                                <tr>
                                    <td align="center"><?= ($i + 1) . "."; ?></td>
                                    <td align="center"><?= $alt[$i]; ?></td>
                                    <?php for ($j = 0; $j < count($kt); $j++) : ?>
                                        <td align="center"><?= $normalisasi[$i][$j] ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3>4. Matriks Terbobot</h3>
                <div style=" overflow-x: auto;">
                    <table class="table datatables table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No.</th>
                                <th style="text-align: center;">Alternatif</th>
                                <?php for ($i = 0; $i < count($kt); $i++) : ?>
                                    <th style="text-align: center;"><?= $kt[$i] ?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($id_alt); $i++) : ?>
                                <tr>
                                    <td align="center"><?= ($i + 1) . "."; ?></td>
                                    <td align="center"><?= $alt[$i]; ?></td>
                                    <?php for ($j = 0; $j < count($kt); $j++) : ?>
                                        <td align="center"><?= $terbobot[$i][$j] ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3>5. Nilai (A+) dan (A-)</h3>
                <table class="table datatables table-striped table-bordered" style="width:100%">
                    <tr>
                        <th style="text-align: center;">Kriteria</th>
                        <th style="text-align: center;">A+</th>
                        <th style="text-align: center;">A-</th>
                    </tr>
                    <?php for ($i = 0; $i < count($kt); $i++) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $kt[$i] ?></td>
                            <td style="text-align: center;"><?= $a_plus[$i] ?></td>
                            <td style="text-align: center;"><?= $a_min[$i] ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
                <hr>
                <h3>6. Nilai (D+) dan (D-)</h3>
                <table class="table datatables table-striped table-bordered" style="width:100%">
                    <tr>
                        <th style="text-align: center;">Alternatif</th>
                        <th style="text-align: center;">A+</th>
                        <th style="text-align: center;">A-</th>
                    </tr>
                    <?php for ($i = 0; $i < count($alt); $i++) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $alt[$i] ?></td>
                            <td style="text-align: center;"><?= $d_plus[$i] ?></td>
                            <td style="text-align: center;"><?= $d_min[$i] ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
                <hr>
                <h3>7. Hasil Akhir</h3>
                <table class="table datatables table-striped table-bordered" style="width:100%">
                    <tr>
                        <th style="text-align: center;">Alternatif</th>
                        <th style="text-align: center;">Nilai</th>
                    </tr>
                    <?php for ($i = 0; $i < count($alt); $i++) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $alt[$i] ?></td>
                            <td style="text-align: center;"><?= $hasil[$i] ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
                <hr>
            </div>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title text-white">Hasil Perhitungan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-md-4">
                        <div class="alert alert-success" role="alert">
                            Berdasarkan hasil perhitungan, " <?= $terpilih[0]['lokasi'] ?> " terpilih sebagai lokasi terbaik. Harap klik <button class="btn btn-success" onclick="location.href='<?= base_url('admin/c_perhitungan/lokasi/' . $terpilih[0]['id']) ?>'">Lihat Lokasi</button> untuk melihat lokasi pada peta.
                        </div>
                    </div>
                </div>
                <table class="table datatables table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">\
                    <thead>
                        <tr>
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Nama Lokasi</th>
                            <th style="text-align: center;">Alamat</th>
                            <th style="text-align: center;">Nilai</th>
                            <th style="text-align: center;">Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($id_alt); $i++) : ?>
                            <tr>
                                <td align="center"><?= ($i + 1) . "."; ?></td>
                                <td><?= $terpilih[$i]['lokasi'] ?></td>
                                <td><?= $terpilih[$i]['alamat'] ?></td>
                                <td><?= $terpilih[$i]['nilai'] ?></td>
                                <td align="center"><?= $terpilih[$i]['rank'] ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function detail() {
        var x = document.getElementById("perhitungan");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>