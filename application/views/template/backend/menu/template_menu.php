<?php
$menu_backend = isset($menu_backend) ? $menu_backend : '';
?>
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse" id="horizontal-navbar">
        <?php 
        echo load_partial('template/backend/menu/item_menu');
        /**
         * lakukan seperti ini 
         */
        /**
        <ul class="nav navbar-nav">
            <li id="li-manage"><a href="<?php echo base_url("back_end/msaplikasi"); ?>"><i class="fa fa-desktop"></i><span>Daftar Aplikasi</span></a></li>
            <li id="li-daftar_pengguna" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle='dropdown'><i class="fa fa-group"></i><span>Daftar Pengguna <i class="fa fa-angle-down"></i></span></a>
                <ul class="dropdown-menu">
                    <li id="li-user_pengguna"><a href="<?php echo base_url("back_end/member"); ?>"><i class="fa fa-user"></i> Anggota</a></li>
                    <li id="li-user_pengembang"><a href="<?php echo base_url("back_end/member/developer"); ?>"><i class="fa fa-user-md"></i> Pengembang</a></li>
                    <li id="li-user_administrator"><a href="<?php echo base_url("back_end/member/administrator"); ?>"><i class="fa fa-asterisk"></i> Administrator</a></li>
                </ul>
            </li>
            <li id="li-masters" class="dropdown">
                <a href="<?php echo base_url('back_end/mskategori') ?>"><i class="fa fa-archive"></i><span>Kategori Aplikasi</span></a>
            </li>
            <li id="li-setting" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle='dropdown'><i class="fa fa-cog"></i><span>Konfigurasi Aplikasi <i class="fa fa-angle-down"></i></span></a>
                <ul class="dropdown-menu">
                    <li id="li-about-gurita-konten"><a href="<?php echo base_url("back_end/about_gurita"); ?>">Tentang Gurita Store</a></li>
                    <li id="li-about-gurita-umpan-balik"><a href="<?php echo base_url("back_end/about_gurita/feedback"); ?>">Umpan Balik</a></li>
                    <li id="li-about-gurita-umpan-balik"><a href="<?php echo base_url("back_end/about_gurita/detail/8/persetujuan_awal"); ?>">Persetujuan Awal Pengembang</a></li>
                </ul>
            </li>
        </ul>
         * 
         */
        ?>
    </div>
</nav>
