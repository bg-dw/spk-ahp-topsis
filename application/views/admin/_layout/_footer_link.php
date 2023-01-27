<!-- Dashboard Core -->
<script src="<?= base_url() ?>\assets\js\vendors\bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>\assets\js\vendors\jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>\assets\js\vendors\selectize.min.js"></script>
<script src="<?= base_url() ?>\assets\js\vendors\jquery.tablesorter.min.js"></script>
<script src="<?= base_url() ?>\assets\js\vendors\circle-progress.min.js"></script>
<script src="<?= base_url() ?>\assets\plugins\rating\jquery.rating-stars.js"></script>

<!-- Fullside-menu Js-->
<script src="<?= base_url() ?>\assets\plugins\fullside-menu\jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>\assets\plugins\fullside-menu\waves.min.js"></script>

<!-- Charts Plugin -->
<script src="<?= base_url() ?>\assets\plugins\chart\Chart.bundle.js"></script>
<script src="<?= base_url() ?>\assets\plugins\chart\utils.js"></script>

<!-- Input Mask Plugin -->
<script src="<?= base_url() ?>\assets\plugins\input-mask\jquery.mask.min.js"></script>

<!-- Custom scroll bar Js-->
<script src="<?= base_url() ?>\assets\plugins\scroll-bar\jquery.mCustomScrollbar.concat.min.js"></script>


<!-- Data tables -->
<script src="<?= base_url() ?>assets\plugins\datatable\jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets\plugins\datatable\dataTables.bootstrap4.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>/assets/plugins/select2/select2.full.min.js"></script>
<!-- Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWxchCqfqjiXGtF0eTU3FRhjD5W8ESmFs&callback=initMap&v=weekly"></script>

<!-- Custom-->
<script src="<?= base_url() ?>assets/js/custom.js"></script>
<!-- Data table js -->
<script>
    $(function(e) {
        $('.datatables').DataTable();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2-multiple').select2();
    });
</script>
<?php if ($this->session->flashdata('alert')) : ?>
    <script>
        $('#alert').modal('show');
    </script>
<?php endif; ?>