<div class="page-header">
    <h4 class="page-title">Kriteria</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Kriteria</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Daftar Kriteria</div>
                <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modal-add">Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatables table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
                        <thead>
                            <tr class="border-bottom-0">
                                <th style="text-align: center;" width="5%">No.</th>
                                <th style="text-align: center;" class="wd-15p">Kriteria</th>
                                <th style="text-align: center;" class="wd-15p">Tipe Kriteria</th>
                                <th style="text-align: center;" class="wd-15p">Bobot</th>
                                <th style="text-align: center;" class="wd-15p">API Map</th>
                                <th style="text-align: center;" class="wd-20p">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($kriteria as $val) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $i . "."; ?></td>
                                    <td><?= $val->nama_kriteria ?></td>
                                    <td style="text-align: center;"><?= $val->tipe_kriteria ?></td>
                                    <td style="text-align: center;"><?= $val->bobot_kriteria ?></td>
                                    <td style="text-align: center;"><?= $val->api_map ?></td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-update" onclick="update('<?= $val->id_kriteria ?>','<?= $val->nama_kriteria ?>','<?= $val->tipe_kriteria ?>','<?= $val->api_map ?>');">Edit</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-del" onclick="del('<?= $val->id_kriteria ?>');">Hapus</button>
                                    </td>
                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>

<!-- Modal -->
<div id="modal-add" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="<?= base_url() ?>admin/c_kriteria/ac_add_kriteria/" method="post">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tambah Kriteria</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" name="kriteria" placeholder="Contoh : Jarak" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Kriteria</label>
                        <div class="row">
                            <div class="col-3">
                                <input type="radio" name="tipe" id="rd_cost" value="COST" checked>
                                <label for="rd_cost">Cost</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" name="tipe" id="rd_benefit" value="BENEFIT">
                                <label for="rd_benefit">Benefit</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Menggunakan Map (Untuk menghitung jarak)</label>
                        <div class="row">
                            <div class="col-3">
                                <input type="radio" name="map" id="rd_map" value="Map">
                                <label for="rd_map">Ya</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" name="map" id="rd_none" value="-" checked>
                                <label for="rd_none">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->

<!-- Modal -->
<div id="modal-update" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="<?= base_url() ?>admin/c_kriteria/ac_update_kriteria/" method="post">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Kriteria</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id" id="u_id_kriteria">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" name="kriteria" placeholder="Contoh : Jarak" required id="u_kriteria">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Kriteria</label>
                        <div class="row">
                            <div class="col-3">
                                <input type="radio" name="tipe" id="u_rd_cost" value="COST">
                                <label for="u_rd_cost">Cost</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" name="tipe" id="u_rd_benefit" value="BENEFIT">
                                <label for="u_rd_benefit">Benefit</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Menggunakan Map (Untuk menghitung jarak)</label>
                        <div class="row">
                            <div class="col-3">
                                <input type="radio" name="map" id="u_rd_map" value="Map">
                                <label for="u_rd_map">Ya</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" name="map" id="u_rd_none" value="-">
                                <label for="u_rd_none">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->

<!-- small Modal -->
<div id="modal-del" class="modal fade">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="<?= base_url() ?>admin/c_kriteria/delete_kriteria/" method="post">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Konfirmasi!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id" id="id_kriteria">
                <div class="modal-body">
                    <center>
                        <p>Hapus data terpilih?</p>
                    </center>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<script>
    function update(id, kriteria, tipe, map) {
        $('#u_id_kriteria').val(id);
        $('#u_kriteria').val(kriteria);
        if (tipe == "COST") {
            $('#u_rd_cost').prop('checked', true);
        } else {
            $('#u_rd_benefit').prop('checked', true);
        }
        if (map == "Map") {
            $('#u_rd_map').prop('checked', true);
        } else {
            $('#u_rd_none').prop('checked', true);
        }
    }

    function del(id) {
        $('#id_kriteria').val(id);
    }
</script>