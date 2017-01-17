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
                </div>
                <div class="block">
                    <div class="dataTables_wrapper no-footer">
                        <div class="table-responsive">
                            <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                <thead>
                                    <tr role="row">
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Tanda Tangan</th>
                                        <th>Tanggal</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($records != FALSE):
                                        ?>
                                        <?php foreach ($records as $key => $record): ?>
                                            <tr>
                                                <td align="right">
                                                    <?php echo $next_list_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->nama_bulan . " " . $record->id_tahun) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->nama_ttd . " - " . $record->pangkat_ttd . " - " . $record->nrp_ttd) ?>
                                                </td>
                                                <td align="center">
                                                    <?php echo pg_date_to_text($record->tanggal_ttd) ?>
                                                </td>
                                                <td align="center">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-default" href="<?php echo base_url("back_end/" . $active_modul . "/detail") . "/" . $record->id_formulir; ?>">Detail</a>
                                                    </div>
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
