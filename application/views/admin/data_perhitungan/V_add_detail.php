<div class="page-header">
    <h4 class="page-title">Data Perhitungan</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Data Perhitungan</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url('admin/c_data_perhitungan/ac_add_data_perhitungan') ?>" method="post" class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Perhitungan</h3>
            </div>
            <div class="card-body">
                <div id="floating-panel" style="margin-bottom: 20px;">
                    <input id="delete-markers" type="button" value="Delete Markers" />
                </div>
                <div class="map-header" style="height: 400px;">
                    <div class="map-header-layer" id="map" style="height: 400px;"></div>
                </div>
                <div class="form-group" style="margin-top: 50px;">
                    <label class="form-label">Nama Lokasi</label>
                    <select class="form-control" name="id_lokasi" required onchange="initMap();" id="sel_loc">
                        <option value="">--Pilih Lokasi--</option>
                        <?php foreach ($lokasi as $val) : ?>
                            <option value="<?= $val->id_lokasi . " " . $val->lat . " " . $val->lang ?>"><?= $val->nama_lokasi ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi (Lk)</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control loc" name="lat" placeholder="Lat" readonly="" required="" id="lat">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control loc" name="lang" placeholder="Lang" readonly="" required="" id="lang">
                        </div>
                    </div>
                </div>
                <?php $i = 0;
                foreach ($kriteria as $key) : ?>
                    <div class="form-group">
                        <label class="form-label"><?= $key->nama_kriteria ?></label>
                        <div class="row">
                            <div class="col-2" style="display: none;">
                                <input type="hidden" class="form-control" name="id_kt[]" value="<?= $key->id_kriteria ?>" required id="kt" readonly>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control loc" name="nilai[]" required id="inp-<?= $i; ?>" <?php if ($key->api_map == "Map") {
                                                                                                                            echo "readonly";
                                                                                                                        } ?>>
                            </div>
                            <?php if ($key->api_map != "-") : ?>
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="radio" class="form-control" name="rd" value="<?= $i; ?>" id="rb-<?= $i; ?>" <?php if ($i == 0) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> onclick="initMap();">
                                    </div>
                                </div>
                            <?php $i++;
                            endif; ?>
                        </div>
                    </div>
                <?php
                endforeach; ?>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex">
                    <button type="button" class="btn btn-default" onclick="location.href='<?= base_url() ?>admin/c_data_perhitungan/';">Batal</button>
                    <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    let map;
    let markers = [];
    const labels = ["Lk", ""];
    let labelIndex = 0;
    let lokasi = [];
    let mypin = []; //lat/lang ke pemukiman
    // let pd = []; //lat/lang sarana pendidikan
    // let tp = []; //lat/lang sarana transportasi

    function initMap() {
        var id = $('#sel_loc').val();
        const myLatlng = { //koordinat center map
            lat: -7.965907578986176,
            lng: 112.60746002197266
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            center: myLatlng
        });
        var detail = id.split(" "); //memecah string menjadi array
        const mysel = { //koordinat terpilih
            lat: Number(detail[1]),
            lng: Number(detail[2])
        };
        deleteLastMarkers(); //menghapus pin sebelumnya
        var rd = $("input[name=rd]:checked").val();
        console.log(rd);
        if (id != "") {
            deleteLastMarkers();
            $('#lat').val(Number(detail[1]));
            $('#lang').val(Number(detail[2]));
            addMarker(mysel);
            lokasi.push(Number(detail[1]), Number(detail[2]));
        } else {
            deleteMarkers();
        }
        map.setZoom(17);
        map.addListener("click", (mapsMouseEvent) => {
            if (labelIndex >= 2) {
                deleteLastMarkers();
            }
            // console.log(labelIndex);
            addMarker(mapsMouseEvent.latLng);
            if (labelIndex == 1) {
                $('#lat').val(Number(detail[1]));
                $('#lang').val(Number(detail[2]));
                deleteLastMarkers();
                addMarker(mysel);
                lokasi.push(Number(detail[1]), Number(detail[2]));
            } else if (labelIndex == 2) {
                mypin.push(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng());
                $('#inp-' + rd).val(distance(lokasi[0], lokasi[1], mypin[0], mypin[1]).toFixed(2));
            }
        });

        // add event listeners for the buttons
        document
            .getElementById("delete-markers")
            .addEventListener("click", deleteMarkers);

        // Adds a marker to the map and push to the array.
        function addMarker(position) {
            const marker = new google.maps.Marker({
                position,
                label: labels[labelIndex++],
                map,
            });

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

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            hideMarkers();
            $('.loc').val("");
            markers = [];
            labelIndex = 0;
            while (mypin.length > 0) { //menghapus array
                mypin.pop();
            }
        }

        function deleteLastMarkers() {
            hideMarkers();
            markers = [];
            labelIndex = 0;
            while (mypin.length > 0) { //menghapus array
                mypin.pop();
            }
        }
    }

    //mencari jarak dengan haversine formula
    function distance(lat1, lon1, lat2, lon2) {
        if ((lat1 == lat2) && (lon1 == lon2)) {
            return 0;
        } else {
            var radlat1 = Math.PI * lat1 / 180;
            var radlat2 = Math.PI * lat2 / 180;
            var theta = lon1 - lon2;
            var radtheta = Math.PI * theta / 180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
                dist = 1;
            }
            dist = Math.acos(dist);
            dist = dist * 180 / Math.PI;
            dist = dist * 60 * 1.1515;
            dist = dist * 1.609344;
            dist = dist * 1000;
            return dist;
        }
    }
</script>