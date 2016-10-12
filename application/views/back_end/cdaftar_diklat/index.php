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
                                <a href="<?php echo base_url('back_end/' . $active_modul . '/detail'); ?>" class="btn btn-success btn-block">
                                    <span class="fa fa-plus"></span> Tambah baru
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block">
                    <div class="dataTables_wrapper no-footer">
                        <div class="table-responsive">
                            <table class="table no-footer" id="DataTables_Table_0">
                                <thead>
                                    <tr role="row">
                                        <th width="5%">
                                            No
                                        </th>
                                        <th>
                                            Nama Diklat
                                        </th>
                                        <th width="5%">
                                            Tanggal Pelaksanaan
                                        </th>
                                        <th width="15%">
                                            Penyelenggara
                                        </th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records != FALSE): ?>
                                        <?php foreach ($records as $key => $record): ?>
                                            <tr>
                                                <td rowspan="2">
                                                    <?php echo $next_list_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->nama_diklat) ?>
                                                    <br />
                                                    Angkatan <?php echo $record->angkatan ?>
                                                    <br />
                                                    Status Pendaftaran <?php echo $record->is_registration_closed == '0' ? "<span class=\"label label-success\">Buka</span>" : "<span class=\"label label-danger\">Tutup</span>"; ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str(show_date_with_format($record->tgl_pelaksanaan), FALSE, "-") ?>
                                                    <br />
                                                    s/d
                                                    <br />
                                                    <?php echo beautify_str(show_date_with_format($record->tgl_selesai), FALSE, "-") ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->penyelenggara, FALSE, "-") ?>
                                                </td>
                                                <td rowspan="2">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-default" href="<?php echo base_url("back_end/" . $active_modul . "/detail") . "/" . $record->id_diklat; ?>">Ubah</a>
                                                        <a class="btn btn-default btn-hapus-row" href="javascript:void(0);" rel="<?php echo base_url("back_end/" . $active_modul . "/delete") . "/" . $record->id_diklat; ?>">Hapus</a>
                                                    </div>
                                                    <br />
                                                    <div class="btn-group">
                                                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Peserta Diklat <span class="caret"></span></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a class="btn-lihat-peserta" href="<?php echo base_url('back_end/cpeserta_diklat/index') . "/" . $record->id_diklat_crypted; ?>" id="btn-lihat-peserta-<?php echo $record->id_diklat_crypted; ?>"><small>Lihat Daftar</small></a>
                                                            </li>
                                                            <li>
                                                                <a class="btn-upload-peserta" href="<?php echo base_url('back_end/cpeserta_diklat/upload') . "/" . $record->id_diklat_crypted; ?>" id="btn-upload-peserta-<?php echo $record->id_diklat_crypted; ?>"><small>Upload</small></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <br />
                                                    <div class="btn-group">
                                                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Administrasi <span class="caret"></span></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a class="btn btn-default btn-sm btn-unduh-spt" href="<?php echo base_url("back_end/" . $active_modul . "/cetak_sttpp") . "/" . $record->id_diklat; ?>" id="btn-unduh-sttpp-<?php echo $record->id_diklat ?>">Unduh STTPP</a>
                                                            </li>
                                                            <li>
                                                                <a class="btn btn-default btn-sm btn-unduh-spt" href="<?php echo base_url("back_end/" . $active_modul . "/cetak_spt") . "/" . $record->id_diklat; ?>" id="btn-unduh-spt-<?php echo $record->id_diklat ?>">Unduh SPT</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    Total Jam : <?php echo beautify_str($record->total_jam, FALSE, "-") ?><br />
                                                    Alamat Lokasi : <?php echo beautify_str($record->alamat_lokasi, FALSE, "-") ?><br />
                                                    Kota : <?php echo beautify_str($record->nama_kabupaten, FALSE, "-") ?><br />
                                                    Provinsi : <?php echo beautify_str($record->nama_provinsi, FALSE, "-") ?>
                                                </td>
                                            </tr>
                                            <?php $next_list_number++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5"> Kosong / Data tidak ditemukan. </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <?php /** <div class="dataTables_info" id="DataTables_Table_0_info">Showing 1 to 10 of 57 entries</div> */ ?>
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