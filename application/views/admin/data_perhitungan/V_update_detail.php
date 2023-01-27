<div class="page-header">
    <h4 class="page-title">Lokasi</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Lokasi</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url('admin/c_data_perhitungan/ac_update_data_perhitungan') ?>" method="post" class="card">
            <div class="card-header">
                <h3 class="card-title">Update Lokasi</h3>
            </div>
            <div class="card-body">
                <div id="floating-panel" style="margin-bottom: 20px;">
                    <input id="delete-markers" type="button" value="Delete Markers" />
                </div>
                <div class="map-header" style="height: 400px;">
                    <div class="map-header-layer" id="map" style="height: 400px;"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama" value="<?= $detail[0]->nama_lokasi ?>" required readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi (Lk)</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control loc" name="lat" value="<?= $detail[0]->lat ?>" placeholder="Lat" readonly="" required="" id="lat">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control loc" name="lang" value="<?= $detail[0]->lang ?>" placeholder="Lang" readonly="" required="" id="lang">
                        </div>
                    </div>
                </div>
                <?php $i = 0;
                foreach ($detail as $key) : ?>
                    <div class="form-group">
                        <label class="form-label"><?= $key->nama_kriteria ?></label>
                        <div class="row">
                            <div class="col-2" style="display: none;">
                                <input type="hidden" class="form-control" name="id_detail[]" value="<?= $key->id_detail ?>" required id="detail" readonly>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control loc" name="nilai[]" value="<?= $key->nilai ?>" required id="inp-<?= $i; ?>" <?php if ($key->api_map == "Map") {
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
    let mypin = []; //lat/lang pin

    function initMap() {
        const myLatlng = { //koordinat center map
            lat: <?= $detail[0]->lat ?>,
            lng: <?= $detail[0]->lang ?>
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            center: myLatlng
        });
        deleteLastMarkers(); //menghapus pin sebelumnya
        addMarker(myLatlng);
        var rd = $("input[name=rd]:checked").val();

        map.setZoom(17);
        // setMarkers(map);
        map.addListener("click", (mapsMouseEvent) => {
            if (labelIndex >= 2) {
                deleteLastMarkers();
            }
            // console.log(labelIndex);
            addMarker(mapsMouseEvent.latLng);
            if (labelIndex == 1) {
                $('#lat').val(<?= $detail[0]->lat ?>);
                $('#lang').val(<?= $detail[0]->lang ?>);
                deleteLastMarkers();
                addMarker(myLatlng);
                lokasi.push(<?= $detail[0]->lat ?>, <?= $detail[0]->lang ?>);
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