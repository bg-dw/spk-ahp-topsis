<nav id="sidebar" class="nav-sidebar">
    <ul class="list-unstyled components" id="accordion">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="<?= base_url('') ?>\assets\images\faces\female\25.jpeg" alt="user-img" class="img-circle"></div>
                <div class="mb-2"><a href="#" class="" data-toggle="" aria-haspopup="true" aria-expanded="false"> <span class="font-weight-semibold"><?= $this->session->userdata('nama'); ?></span> </a>
                    <br><span class="text-gray">Admin</span>
                </div>
            </div>
        </div>

        <li>
            <a href="<?= base_url() ?>" class=" wave-effect">
                <i class="fa fa-desktop mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/c_lokasi/') ?>" class=" wave-effect">
                <i class="fa fa-map-marker mr-2"></i> Lokasi
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/c_kriteria/') ?>" class=" wave-effect">
                <i class="mdi mdi-tune mr-2"></i> Kriteria
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/c_data_perhitungan/') ?>" class=" wave-effect">
                <i class="mdi mdi-buffer mr-2"></i> Data Perhitungan
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/c_perhitungan/') ?>" class=" wave-effect">
                <i class="mdi mdi-airplay mr-2"></i> Perhitungan
            </a>
        </li>
    </ul>
</nav>