<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</div>

<div class="row row-cards">
    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12">
        <div class="card bg-primary shadow-primary">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-right">
                        <i class="mdi mdi-pin text-white icon-size"></i>
                    </div>
                    <div class="float-left">
                        <p class="mb-0 text-left text-white">Lokasi</p>
                        <div>
                            <h3 class="font-weight-semibold text-left mb-0 text-white"><?= $lokasi ?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-white mb-0">
                    <i class="mdi mdi-arrow-up-drop-circle mr-1 text-success" aria-hidden="true"></i> Google Maps
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12">
        <div class="card bg-primary shadow-primary">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-right">
                        <i class="mdi mdi-poll-box text-white icon-size"></i>
                    </div>
                    <div class="float-left">
                        <p class="mb-0 text-left text-white">Kriteria</p>
                        <div>
                            <h3 class="font-weight-semibold text-left mb-0 text-white"><?= $kriteria ?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-white mb-0">
                    <i class="mdi mdi-arrow-up-drop-circle mr-1 text-success" aria-hidden="true"></i> Kriteria Penilaian
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Company profit</h3>
            </div>
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
            url: "<?= base_url('admin/home/get_lokasi/') ?>",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    const loc = { //koordinat map
                        lat: Number(data[i].lat),
                        lng: Number(data[i].lang)
                    };
                    const msg =
                        '<div id="content">' +
                        '<div id="siteNotice">' +
                        "</div>" +
                        '<h2 id="firstHeading" class="firstHeading">' + data[i].nama_lokasi + '</h2>' +
                        '<div id="bodyContent">' +
                        data[i].alamat_lokasi +
                        "</div>" +
                        "</div>";
                    addMarker(loc, msg);

                }
            }
        });

        function addInfo(marker, msg) {
            const infowindow = new google.maps.InfoWindow({
                content: msg,
            });

            marker.addListener("click", () => {
                infowindow.close();
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