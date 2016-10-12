<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
$field_id = isset($field_id) ? $field_id : FALSE;
$paging_set = isset($paging_set) ? $paging_set : FALSE;
$active_modul = isset($active_modul) ? $active_modul : 'none';
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
?>
<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">                                
                <h3 class="panel-title"><?php echo $header_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="block">
                    <?php echo load_partial("back_end/shared/attention_message"); ?>
                    <p>Gunakan Formulir ini untuk melakukan pencarian pada halaman ini.</p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-search"></span>
                                    </div>
                                    <input type="text" name="keyword" value="<?php echo $keyword; ?>" class="form-control" placeholder="Silahkan masukkan kata kunci disini"/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a id="btn-tambah-pegawai" href="<?php echo base_url('back_end/' . $active_modul . '/detail'); ?>" class="btn btn-success btn-block">
                                    <span class="fa fa-plus"></span> Tambah baru
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block">
                    <div class="row">
                        <?php if ($records != FALSE): ?>
                            <?php foreach ($records as $key => $record): ?>
                                <div class="col-md-3">
                                    <!-- CONTACT ITEM -->
                                    <div class="panel panel-default">
                                        <div class="panel-body profile">
                                            <div class="profile-image">
                                                <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="User"/>
                                            </div>
                                            <div class="profile-data">
                                                <div class="profile-data-name"><?php echo beautify_str($record->nama_sambung) ?></div>
                                                <div class="profile-data-title">NIP. <?php echo beautify_str($record->nip) ?></div>
                                            </div>
                                        </div>                                
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="clsHistoryPegawai btn btn-default"  href="<?php echo base_url("back_end/" . $active_modul . "/history") . "/" . $record->id_pegawai; ?>">Detil</a>
                                                        <a class="clsUbahPegawai btn btn-default"  href="<?php echo base_url("back_end/" . $active_modul . "/detail") . "/" . $record->id_pegawai; ?>">Ubah</a>
                                                        <a class="clsHapusPegawai btn btn-default  btn-hapus-row"  href="javascript:void(0);" rel="<?php echo base_url("back_end/" . $active_modul . "/delete") . "/" . $record->id_pegawai; ?>">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div>
                                    <!-- END CONTACT ITEM -->
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>Tidak ada pegawai yang terdaftar.</div>
                        <?php endif; ?>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $paging_set;
                            ?>                           
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>