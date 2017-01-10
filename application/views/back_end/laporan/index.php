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
                                <label class="control-label">Formulir</label>
                                <select name="formulir" class="form-control">
                                    <option>A</option>
                                </select>
                                <label class="control-label">Tahun</label>
                                <select name="tahun" class="form-control">
                                    <option>A</option>
                                </select>
                                <label class="control-label">Nama Kotama</label>
                                <select name="kotama" class="form-control">
                                    <option>A</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-success btn-block">
                                    <span class="fa fa-search"></span> Cari
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
                                        <th>No</th>
                                        <th width="15%">Kotama</th>
                                        <th width="15%">Pangkat</th>
                                        <th width="15%">Secata</th>
                                        <th width="15%">Secaba</th>
                                        <th width="15%">Sesarcab</th>
                                        <th width="15%">Selapa</th>
                                        <th width="15%">Sesko Angkatan</th>
                                        <th width="15%">Sesko TNI</th>
                                        <th width="15%">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records != FALSE): ?>
                                        <?php foreach ($records as $key => $record): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $next_list_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->ur_kotama) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->ur_pangkat) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_secata) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_secaba) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_sesarcab) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_selapa_setingkat) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_sesko_angkatan_setingkat) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_sesko_tni) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_subtotal) ?>
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