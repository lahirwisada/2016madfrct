<?php
$header_title = isset($header_title) ? $header_title : '';
$detail = isset($detail) ? $detail : FALSE;
?>
<div class="row">

    <div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-body profile profile-pegawai" style="background-color: #c0c5c8;">
                <div class="profile-image">
                    <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="<?php echo $detail ? $detail->nama_sambung : ""; ?>"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $detail ? $detail->nama_sambung : "Nama"; ?></div>
                    <div class="profile-data-title" style="color: #FFF;"><?php echo $detail ? $detail->nip : "NIP"; ?></div>
                </div>
            </div>
            <div class="panel-body list-group border-bottom">
                <a href="#" onclick="return false;" class="list-group-item">TTL : <?php echo $detail ? $detail->tempat_lahir . ', ' . show_date_with_format($detail->tgl_lahir, 'd-m-Y', 'Y-m-d') : ""; ?></a>
                <a href="#" onclick="return false;" class="list-group-item">Pangkat Terakhir : <?php echo $detail ? $detail->keterangan_golongan . "(" . $detail->golongan . ")" : ""; ?></a>
                <a href="#" onclick="return false;" class="list-group-item">Jabatan Terakhir : <?php echo $detail ? $detail->jabatan : ""; ?></a>
                <a href="#" onclick="return false;" class="list-group-item">Unit Kerja : <?php echo $detail ? $detail->nama_skpd : ""; ?></a>
            </div>
        </div>
    </div>

    <div class="col-md-9">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default nav-tabs-justified">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $header_title; ?> : Riwayat Diklat Pegawai</h3>
            </div>
            <div class="panel-body">
                <div id="diklat-pegawai">
                    <?php echo load_partial('back_end/cref_pegawai/history/diklat_pegawai'); ?>
                </div>
            </div>

        </div>
    </div>
</div>