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
                                            PANGKAT
                                        </th>
                                        <th>
                                            SECATA
                                        </th>
                                        <th>
                                            SECABA
                                        </th>
                                        <th>
                                            SESARCAB
                                        </th>
                                        <th>
                                            SELAPA SETINGKAT
                                        </th>
                                        <th>
                                            SESKO ANGK SETINGKAT
                                        </th>
                                        <th>
                                            SESKO TNI
                                        </th>
                                        <th>
                                            JUMLAH
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records != FALSE): ?>
                                        <?php
                                        $jumlah_secata = 0;
                                        $jumlah_secaba = 0;
                                        $jumlah_sesarcab = 0;
                                        $jumlah_selapa_setingkat = 0;
                                        $jumlah_sesko_angkatan_setingkat = 0;
                                        $jumlah_sesko_tni = 0;
                                        $jumlah_subtotal = 0;
                                        ?>
                                        <?php foreach ($records as $key => $record): ?>

                                            <tr>
                                                <td>
                                                    <?php echo $next_list_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->ur_pangkat); ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_secata); ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_secaba); ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_sesarcab); ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_selapa_setingkat); ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_sesko_angkatan_setingkat); ?>
                                                </td>
                                                <td>
                                                    <?php echo beautify_str($record->jumlah_sesko_tni); ?>
                                                </td>
                                                <td>
                                                    <strong><?php echo beautify_str($record->jumlah_subtotal); ?></strong>
                                                </td>
                                            </tr>
                                            <?php
                                            $jumlah_secata +=$record->jumlah_secata;
                                            $jumlah_secaba +=$record->jumlah_secaba;
                                            $jumlah_sesarcab +=$record->jumlah_sesarcab;
                                            $jumlah_selapa_setingkat +=$record->jumlah_selapa_setingkat;
                                            $jumlah_sesko_angkatan_setingkat +=$record->jumlah_sesko_angkatan_setingkat;
                                            $jumlah_sesko_tni +=$record->jumlah_sesko_tni;
                                            $jumlah_subtotal +=$record->jumlah_subtotal;
                                            ?>
                                            <?php $next_list_number++; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td>

                                            </td>
                                            <td>Jumlah</td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_secata); ?></strong>
                                            </td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_secaba); ?></strong>
                                            </td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_sesarcab); ?></strong>
                                            </td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_selapa_setingkat); ?></strong>
                                            </td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_sesko_angkatan_setingkat); ?></strong>
                                            </td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_sesko_tni); ?></strong>
                                            </td>
                                            <td>
                                                <strong><?php echo beautify_str($jumlah_subtotal); ?></strong>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5"> Kosong / Data tidak ditemukan. </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <a href="<?php echo base_url('back_end/' . $active_modul . '/index'); ?>" class="btn btn-block">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>