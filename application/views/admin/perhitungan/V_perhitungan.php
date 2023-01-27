<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</div>
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <form action="<?= base_url('admin/c_perhitungan/hasil_perhitungan/') ?>" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-md-4">
                            <div class="alert alert-warning" role="alert">
                                Ketentuan Penilaian :
                                <table>
                                    <tr>
                                        <td>1.Sama Penting</td>
                                    </tr>
                                    <tr>
                                        <td>3.Sedikit Penting</td>
                                    </tr>
                                    <tr>
                                        <td>5.Cukup Penting</td>
                                    </tr>
                                    <tr>
                                        <td>7.Sangat Penting</td>
                                    </tr>
                                    <tr>
                                        <td>9.Sangat Penting Sekali</td>
                                    </tr>
                                    <tr>
                                        <td>2,4,6,8,Nilai tengah diantara nilai yang berdekatan.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped" width="100%" border="1">
                            <tr>
                                <th style="text-align: center;">Kriteria A</th>
                                <th style="text-align: center;">Nilai</th>
                                <th style="text-align: center;">Kriteria B</th>
                            </tr>
                            <?php $x = 0;
                            for ($i = 0; $i < count($kriteria['id']); $i++) :
                                for ($j = $i; $j < count($kriteria['id']); $j++) :
                                    if ($kriteria['id'][$i] != $kriteria['id'][$j]) : ?>
                                        <tr>
                                            <td>
                                                <label class="form-label"><?= $kriteria['nama'][$i]; ?></label>
                                            </td>
                                            <td>
                                                <div class="slidecontainer">
                                                    <center style="margin-bottom: 5px;"><span id="val-<?= $x; ?>" class="num"></span></center>
                                                    <input type="range" min="-8" name="nilai[]" max="8" class="slider inp" id="myRange-<?= $x; ?>">
                                                </div>
                                                <!-- <input type="number" min="1" max="9" class="form-control" name="nilai[]" value="1" required style="text-align: center;"> -->
                                            </td>
                                            <td>
                                                <label class="form-label"><?= $kriteria['nama'][$j]; ?></label>
                                            </td>
                                        </tr>
                            <?php $x++;
                                    endif;
                                endfor;
                            endfor; ?>
                            <input type="hidden" value="<?= $x ?>" id="tot_inp">
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-4">
                            <div class="mb-3 select2-blue">
                                <label style="font-weight: bold;"> Pilih Lokasi :</label><br>
                                <input type="checkbox" id="cek" name="cek" onclick="set_opt()">
                                <label for="cek"> Pilih Semua</label><br>
                                <select class="form-control select2-multiple" name="lokasi[]" multiple="multiple" data-dropdown-css-class="select2-blue" id="sel" required>
                                    <?php
                                    foreach ($lokasi as $val) { ?>
                                        <option value="<?= $val->id_lokasi; ?>" style="color: black;"> <?= $val->nama_lokasi . " [" . $val->alamat_lokasi . "]"; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span style="color: red;"><i>*Harap pilih minimal 2 lokasi</i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function set_opt() {
        var options = $('#sel option'); //inisialisasi select

        var values = $.map(options, function(option) { //mengambil semua value dari select
            return option.value;
        });
        var multiple = $(".select2-multiple").select2();
        if ($('#cek').prop("checked") == true) {
            multiple.val(values).trigger("change"); //set isi select
        } else if ($('#cek').prop("checked") == false) {
            multiple.val(null).trigger("change"); //hapus isi select
        }
    };

    $(function() {
        $('.inp').val(0);
        $('.num').text(1);
    });
    $(".inp").change(function(event) {
        var id_range = event.target.id;
        var num = id_range.split("-");
        var slider = $('#myRange-' + num[1]);
        var output = document.getElementById("val-" + num[1]);
        output.innerHTML = Math.abs(slider.val()) + 1;
    });
</script>