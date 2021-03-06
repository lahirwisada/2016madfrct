<?php
$header_title = isset($header_title) ? $header_title : '';
$keyword = isset($keyword) ? $keyword : '';
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
                <?php echo load_partial("back_end/shared/attention_message"); ?>
                <form class="form-panel">
                    <?php if ($id_kotama > 0): ?>
                        <div class="btn-group">
                            <a href="<?php echo base_url('back_end/' . $active_modul . '/download/' . $id_kotama); ?>" class="btn btn-primary">
                                <span class="fa fa-download"></span> Download Template
                            </a>
                            <a href="<?php echo base_url('back_end/' . $active_modul . '/detail'); ?>" class="btn btn-primary">
                                <span class="fa fa-plus"></span> Rekap Baru
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <?php
                                $options = array();
                                $options[''] = 'Semua Kotama';
                                foreach ($list_kotama as $row) {
                                    $options[$row->id_kotama] = $row->nama_kotama;
                                }
                                echo form_dropdown('kotama', $options, set_value('kotama', $kotama), 'class="form-control"');
                                ?>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary">Pilih Kotama</button>
                                    <?php if ($kotama != NULL): ?>
                                        <a href="<?php echo base_url('back_end/' . $active_modul . '/download/' . $kotama); ?>" class="btn btn-primary">
                                            <span class="fa fa-download"></span> Download Template
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-primary"<?php echo $kotama != NULL ? '' : "disabled" ?>><span class="fa fa-download"></span> Download Template</button>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url('back_end/' . $active_modul . '/detail'); ?>" class="btn btn-primary">
                                        <span class="fa fa-plus"></span> Rekap Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <tr role="row">
                                <th>
                                    No
                                </th>
                                <th>
                                    Kotama
                                </th>
                                <th>
                                    Bulan
                                </th>
                                <th>
                                    Tgl Upload
                                </th>
                                <th>
                                    TTD
                                </th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($records != FALSE): ?>
                                <?php foreach ($records as $key => $record): ?>
                                    <tr>
                                        <td class="text-right">
                                            <?php echo $next_list_number; ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->ur_kotama); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->nama_bulan) . " " . $record->id_tahun ?>
                                        </td>
                                        <td>
                                            <?php echo pg_date_to_text($record->tanggal_upload); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->nama_ttd) . " (NRP. " . $record->nrp_ttd . ")"; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-default" href="<?php echo base_url("back_end/" . $active_modul . "/view") . "/" . $record->id_rekap; ?>">Lihat</a>
                                                <a class="btn btn-default" href="<?php echo base_url("back_end/" . $active_modul . "/detail") . "/" . $record->id_rekap; ?>">Ubah</a>
                                                <a class="btn btn-default btn-hapus-row" href="javascript:void(0);" rel="<?php echo base_url("back_end/" . $active_modul . "/delete") . "/" . $record->id_rekap; ?>">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $next_list_number++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6"> Kosong / Data tidak ditemukan. </td>
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
