<?php
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
//var_dump($detail);exit;
$cb_jenis_diklat = isset($cb_jenis_diklat) ? $cb_jenis_diklat : FALSE;
?>

<div class="row">
    <div class="col-md-12">

        <form id="frm-daftar-diklat" enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default tabs">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?></strong></h3>
                </div>

                <div id="form-input-diklat-tab" class="tabs">

                    <ul class="nav nav-tabs nav-justified">
                        <li id="li-isian-diklat" class="active"><a id="a-isian-diklat" href="#isian-diklat" data-toggle="tab">Isian Diklat</a></li>
                        <li><a href="#konfigurasi-spt" data-toggle="tab">Konfigurasi SPT</a></li>
                        <li id="li-tahapan-diklat"><a id="a-tahapan-diklat" href="#tahapan-diklat" data-toggle="tab">Tahapan</a></li>
                        <li><a href="#dasar-spt" data-toggle="tab">Dasar SPT</a></li>
                        <li><a href="#tembusan-spt" data-toggle="tab">Tembusan SPT</a></li>
                        <li><a href="#hal-perhatian-spt" data-toggle="tab">Hal Perhatian</a></li>
                        <li><a href="#sttpp" data-toggle="tab">Konfigurasi STTPP</a></li>
                        <li><a href="#persyaratan" data-toggle="tab">Persyaratan</a></li>
                    </ul>

                    <div class="panel-body tab-content">
                        <div class="tab-pane" id="konfigurasi-spt">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_konfigurasi_spt'); ?>
                        </div>
                        <div class="tab-pane" id="tahapan-diklat">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_tahapan_diklat'); ?>
                        </div>
                        <div class="tab-pane" id="dasar-spt">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_dasar_spt'); ?>
                        </div>
                        <div class="tab-pane" id="tembusan-spt">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_tembusan_spt'); ?>
                        </div>
                        <div class="tab-pane active" id="isian-diklat">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_isian_diklat'); ?>
                        </div>
                        <div class="tab-pane" id="hal-perhatian-spt">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_hal_perhatian_spt'); ?>
                        </div>
                        <div class="tab-pane" id="sttpp">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_konfigurasi_sttpp'); ?>
                        </div>
                        <div class="tab-pane" id="persyaratan">
                            <?php echo load_partial('back_end/cdaftar_diklat/detail_persyaratan_diklat'); ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button id="btn-submit-form-daftar-diklat" type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/" . $active_modul . "/index"); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>