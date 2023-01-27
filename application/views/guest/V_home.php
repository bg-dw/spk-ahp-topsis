<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</div>
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <div class="map-header" style="height: 300px;margin-bottom: 10px;">
                        <div class="map-header-layer" id="map" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <form action="<?= base_url('c_perhitungan/') ?>" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-md-4">
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
                        <div class="col-md-8">
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
                                        <input type="checkbox" id="cek" name="cek" onclick="set_opt()">
                                        <label for="cek"> Pilih Semua</label><br>
                                        <select class="form-control select2-multiple" name="lokasi[]" multiple="multiple" data-dropdown-css-class="select2-blue" id="sel" required>
                                            <?php
                                            foreach ($loc as $val) { ?>
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
<script>
    let map;
    let markers = [];
    const labels = [""];
    let labelIndex = 0;

    function initMap() {
        const myLatlng = { //koordinat center map
            lat: <?= $loc[0]->lat ?>,
            lng: <?= $loc[0]->lang ?>
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            center: myLatlng
        });
        map.setZoom(17);
        // setMarkers(map);

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?= base_url('home/get_lokasi/') ?>",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    const loc = { //koordinat map
                        lat: Number(data[i].lat),
                        lng: Number(data[i].lang)
                    };
                    const msg =
                        '<div id="content">' +
                        '<h3 id="firstHeading" class="firstHeading">' + data[i].nama_lokasi + '</h3>' +
                        '<br>' +
                        data[i].alamat_lokasi;
                    addMarker(loc, msg);

                }
            }
        });

        function addInfo(marker, msg) {
            const infowindow = new google.maps.InfoWindow({
                content: msg
            });

            marker.addListener("click", () => {
                infowindow.open(marker.get("map"), marker);
            });
        }

        // Adds a marker to the map and push to the array.
        function addMarker(position, msg) {
            const marker = new google.maps.Marker({
                position,
                label: labels[0],
                map,
                animation: google.maps.Animation.DROP
            });
            addInfo(marker, msg);

            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function hideMarkers() {
            setMapOnAll(null);
        }
    }
</script>