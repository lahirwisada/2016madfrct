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
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Kode Golongan
                                        </th>
                                        <th>
                                            Golongan
                                        </th>
                                        <th>
                                            Keterangan
                                        </th>
                                        <th width="15%">Aksi</th>
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
                                                    <?php echo beautify_str($record->kode_golongan) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->golongan) ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->keterangan) ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-default" href="<?php echo base_url("back_end/" . $active_modul . "/detail") . "/" . $record->id_golongan; ?>">Ubah</a>
                                                        <a class="btn btn-default btn-hapus-row" href="javascript:void(0);" rel="<?php echo base_url("back_end/" . $active_modul . "/delete") . "/" . $record->id_golongan; ?>">Hapus</a>
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