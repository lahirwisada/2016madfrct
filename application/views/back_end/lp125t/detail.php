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
                <div class = "block">
                    <?php
                    foreach ($records as $kotama => $data) {
                        $next_list_number = 1;
                        ?>
                        <div><strong>Kesatuan : <?php echo $kotama; ?></strong></div>
                        <div class = "dataTables_wrapper no-footer">
                            <div class = "table-responsive">
                                <table class = "table no-footer table-bordered table-condensed table-striped" id = "DataTables_Table_0">
                                    <thead>
                                        <tr role = "row">
                                            <th width="5%">No</th>
                                            <th width="25%">PANGKAT</th>
                                            <th width="10%">SECATA</th>
                                            <th width="10%">SECABA</th>
                                            <th width="10%">SESARCAB</th>
                                            <th width="10%">SELAPA SETINGKAT</th>
                                            <th width="10%">SESKO ANGK SETINGKAT</th>
                                            <th width="10%">SESKO TNI</th>
                                            <th width="10%">JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($data != FALSE):
                                            ?>
                                            <?php
                                            $jumlah_secata = 0;
                                            $jumlah_secaba = 0;
                                            $jumlah_sesarcab = 0;
                                            $jumlah_selapa_setingkat = 0;
                                            $jumlah_sesko_angkatan_setingkat = 0;
                                            $jumlah_sesko_tni = 0;
                                            $jumlah_subtotal = 0;
                                            ?>
                                            <?php foreach ($data as $record): ?>

                                                <tr>
                                                    <td align="right">
                                                        <?php echo $next_list_number; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo beautify_str($record->ur_pangkat); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_secata); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_secaba); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_sesarcab); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_selapa_setingkat); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_sesko_angkatan_setingkat); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_sesko_tni); ?>
                                                    </td>
                                                    <td align="right">
                                                        <strong>
                                                            <?php
                                                            $subtotal = $record->jumlah_secata + $record->jumlah_secaba + $record->jumlah_sesarcab + $record->jumlah_selapa_setingkat + $record->jumlah_sesko_angkatan_setingkat + $record->jumlah_sesko_tni;
                                                            echo beautify_str($subtotal);
                                                            ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <?php
                                                $jumlah_secata +=$record->jumlah_secata;
                                                $jumlah_secaba +=$record->jumlah_secaba;
                                                $jumlah_sesarcab +=$record->jumlah_sesarcab;
                                                $jumlah_selapa_setingkat +=$record->jumlah_selapa_setingkat;
                                                $jumlah_sesko_angkatan_setingkat +=$record->jumlah_sesko_angkatan_setingkat;
                                                $jumlah_sesko_tni +=$record->jumlah_sesko_tni;
                                                $jumlah_subtotal +=$subtotal;
                                                ?>
                                                <?php $next_list_number++; ?>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td align="center" colspan="2">Jumlah</td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_secata); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_secaba); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_sesarcab); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_selapa_setingkat); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_sesko_angkatan_setingkat); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_sesko_tni); ?></strong>
                                                </td>
                                                <td align="right">
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
                            </div>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <a href="<?php echo base_url('back_end/' . $active_modul . '/index'); ?>" class="btn btn-block">
                        Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>