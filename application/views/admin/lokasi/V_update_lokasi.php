<div class="page-header">
    <h4 class="page-title">Lokasi</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Lokasi</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url('admin/c_lokasi/ac_update_lokasi') ?>" method="post" class="card">
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
                <div class="form-group" style="margin-top: 50px;">
                    <input type="hidden" name="id_lokasi" value="<?= $lokasi->id_lokasi ?>" required>
                    <label class="form-label">Lokasi (Lat/Lang)</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" name="lat" placeholder="Lat" readonly="" value="<?= $lokasi->lat ?>" required="" id="lat">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="lang" placeholder="Lang" readonly="" value="<?= $lokasi->lang ?>" required="" id="lang">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama" value="<?= $lokasi->nama_lokasi ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Lokasi</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $lokasi->alamat_lokasi ?>" required>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex">
                    <button type="button" class="btn btn-default" onclick="location.href='<?= base_url() ?>admin/c_lokasi/';">Batal</button>
                    <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    let map;
    let markers = [];
    const labels = [""];
    let labelIndex = 0;
    let lokasi = [];

    function initMap() {
        const myLatlng = { //koordinat center map
            lat: <?= $lokasi->lat ?>,
            lng: <?= $lokasi->lang ?>
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            center: myLatlng
        });
        map.setZoom(17);
        addMarker(myLatlng);
        map.addListener("click", (mapsMouseEvent) => {
            if (labelIndex >= 1) {
                deleteMarkers();
            }
            // console.log(labelIndex);
            addMarker(mapsMouseEvent.latLng);
            lokasi.push(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng());
            $('#lat').val(mapsMouseEvent.latLng.lat());
            $('#lang').val(mapsMouseEvent.latLng.lng());
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
            markers = [];
            labelIndex = 0;
            while (lokasi.length > 0) { //menghapus array
                lokasi.pop();
            }
        }
    }
</script>