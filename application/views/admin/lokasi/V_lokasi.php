<div class="page-header">
    <h4 class="page-title">Lokasi</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Lokasi</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Daftar Lokasi</div>
                <button class="btn btn-primary ml-auto" onclick="location.href='<?= base_url() ?>admin/c_lokasi/add_lokasi/';">Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatables table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
                        <thead>
                            <tr class="border-bottom-0">
                                <th style="text-align: center;" width="5%">No.</th>
                                <th style="text-align: center;" class="wd-15p">Nama Lokasi</th>
                                <th style="text-align: center;" class="wd-15p">Alamat</th>
                                <th style="text-align: center;" class="wd-10p">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($lokasi as $val) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $i . "."; ?></td>
                                    <td><?= $val->nama_lokasi ?></td>
                                    <td><?= $val->alamat_lokasi ?></td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-warning btn-sm" onclick="location.href='<?= base_url() ?>admin/c_lokasi/update_lokasi/<?= $val->id_lokasi ?>';">Edit</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-del" onclick="del('<?= $val->id_lokasi ?>');">Hapus</button>
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
<!-- small Modal -->
<div id="modal-del" class="modal fade">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="<?= base_url() ?>admin/c_lokasi/delete_lokasi/" method="post">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Konfirmasi!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id" id="id_lokasi">
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
    function del(id) {
        $('#id_lokasi').val(id);
    }
</script>