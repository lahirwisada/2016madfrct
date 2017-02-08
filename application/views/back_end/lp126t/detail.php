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
//                    var_dump($records);exit();
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
                                            <th width="15%">PANGKAT</th>
                                            <th width="7%">SD</th>
                                            <th width="7%">SLTP</th>
                                            <th width="7%">SLTA</th>
                                            <th width="7%">D1</th>
                                            <th width="7%">D2</th>
                                            <th width="7%">D3</th>
                                            <th width="7%">D4</th>
                                            <th width="7%">S1</th>
                                            <th width="7%">S2</th>
                                            <th width="7%">S3</th>
                                            <th width="10%">JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($data != FALSE):
                                            ?>
                                            <?php
                                            $jumlah_sd = 0;
                                            $jumlah_sltp = 0;
                                            $jumlah_slta = 0;
                                            $jumlah_d1 = 0;
                                            $jumlah_d2 = 0;
                                            $jumlah_d3 = 0;
                                            $jumlah_d4 = 0;
                                            $jumlah_s1 = 0;
                                            $jumlah_s2 = 0;
                                            $jumlah_s3 = 0;
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
                                                        <?php echo beautify_str($record->jumlah_sd); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_sltp); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_slta); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_d1); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_d2); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_d3); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_d4); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_s1); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_s2); ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php echo beautify_str($record->jumlah_s3); ?>
                                                    </td>
                                                    <td align="right">
                                                        <strong>
                                                            <?php
                                                            $subtotal = $record->jumlah_sd + $record->jumlah_sltp + $record->jumlah_slta + $record->jumlah_d1 + $record->jumlah_d2 + $record->jumlah_d3 + $record->jumlah_d4 + $record->jumlah_s1 + $record->jumlah_s2 + $record->jumlah_s3;
                                                            echo beautify_str($subtotal);
                                                            ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <?php
                                                $jumlah_sd += $record->jumlah_sd;
                                                $jumlah_sltp += $record->jumlah_sltp;
                                                $jumlah_slta += $record->jumlah_slta;
                                                $jumlah_d1 += $record->jumlah_d1;
                                                $jumlah_d2 += $record->jumlah_d2;
                                                $jumlah_d3 += $record->jumlah_d3;
                                                $jumlah_d4 += $record->jumlah_d4;
                                                $jumlah_s1 += $record->jumlah_s1;
                                                $jumlah_s2 += $record->jumlah_s2;
                                                $jumlah_s3 += $record->jumlah_s3;
                                                $jumlah_subtotal += $subtotal;
                                                ?>
                                                <?php $next_list_number++; ?>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td align="center" colspan="2">Jumlah</td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_sd); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_sltp); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_slta); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_d1); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_d2); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_d3); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_d4); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_s1); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_s2); ?></strong>
                                                </td>
                                                <td align="right">
                                                    <strong><?php echo beautify_str($jumlah_s3); ?></strong>
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