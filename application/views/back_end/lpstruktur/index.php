<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
//var_dump($records);exit();
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
                    <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PASUKAN DALAM STRUKTUR TNI AD</div>
                    <div class="text-center" style="font-weight: bold;">TRIWULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                </div>
                <div class="block">
                    <div class="dataTables_wrapper no-footer">
                        <div class="table-responsive">
                            <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                <thead>
                                    <tr role="row">
                                        <th class="text-center" rowspan="2">GOLONGAN/PANGKAT</th>
                                        <th class="text-center" rowspan="2" width="9%">TOP</th>
                                        <th class="text-center" colspan="5">KEKUATAN NYATA</th>
                                        <th class="text-center" rowspan="2" width="9%">+/-</th>
                                        <th class="text-center" rowspan="2" width="9%">%</th>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-center" width="9%">DINAS</th>
                                        <th class="text-center" width="9%">MPP</th>
                                        <th class="text-center" width="9%">LF</th>
                                        <th class="text-center" width="9%">SKORSING</th>
                                        <th class="text-center" width="9%">JUMLAH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">(1)</td>
                                        <td class="text-center">(2)</td>
                                        <td class="text-center">(3)</td>
                                        <td class="text-center">(4)</td>
                                        <td class="text-center">(5)</td>
                                        <td class="text-center">(6)</td>
                                        <td class="text-center">(7)</td>
                                        <td class="text-center">(8)</td>
                                        <td class="text-center">(9)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">&nbsp;</td>
                                    </tr>
                                    <?php
                                    if ($records != FALSE):
                                        $total_top = 0;
                                        $total_dinas = 0;
                                        $total_mpp = 0;
                                        $total_lf = 0;
                                        $total_skorsing = 0;
                                        $total_total = 0;
                                        ?>
                                        <?php
                                        foreach ($records['dalam'] as $key => $record):
                                            $sub_top = 0;
                                            $sub_dinas = 0;
                                            $sub_mpp = 0;
                                            $sub_lf = 0;
                                            $sub_skorsing = 0;
                                            $sub_total = 0;
                                            ?>
                                            <tr>
                                                <td><b><u><?php echo beautify_str($key) ?></u></b></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php foreach ($record as $row): ?>
                                                <?php
                                                $total = $row->dinas + $row->mpp + $row->lf + $row->skorsing;
                                                $sub_top += $row->top;
                                                $sub_dinas += $row->dinas;
                                                $sub_mpp += $row->mpp;
                                                $sub_lf += $row->lf;
                                                $sub_skorsing += $row->skorsing;
                                                $sub_total += $total;
                                                ?>
                                                <tr>
                                                    <td><?php echo beautify_str($row->ur_pangkat) ?></td>
                                                    <td align="right"><?php echo number_format($row->top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->dinas, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->mpp, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->lf, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->skorsing, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total - $row->top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->top == 0 ? 0 : $total / $row->top * 100, 2, ",", ".") ?>%</td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            $total_top += $sub_top;
                                            $total_dinas += $sub_dinas;
                                            $total_mpp += $sub_mpp;
                                            $total_lf += $sub_lf;
                                            $total_skorsing += $sub_skorsing;
                                            $total_total += $sub_total;
                                            ?>
                                            <tr>
                                                <td><b>JUMLAH <?php echo beautify_str($key) ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_top, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_dinas, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_mpp, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_lf, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_skorsing, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_total, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_total - $sub_top, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_top == 0 ? 0 : $sub_total / $sub_top * 100, 2, ",", ".") ?>%</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="9">&nbsp;</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><b>JUMLAH BESAR</b></td>
                                            <td align="right"><b><?php echo number_format($total_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_dinas, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_mpp, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_lf, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_skorsing, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_total, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_total - $total_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_top == 0 ? 0 : $total_total / $total_top * 100, 2, ",", ".") ?>%</b></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9"> Kosong / Data tidak ditemukan. </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PASUKAN LUAR STRUKTUR TNI AD</div>
                    <div class="text-center" style="font-weight: bold;">TRIWULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                </div>
                <div class="block">
                    <div class="dataTables_wrapper no-footer">
                        <div class="table-responsive">
                            <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                <thead>
                                    <tr role="row">
                                        <th class="text-center" rowspan="2">GOLONGAN/PANGKAT</th>
                                        <th class="text-center" rowspan="2" width="9%">TOP</th>
                                        <th class="text-center" colspan="5">KEKUATAN NYATA</th>
                                        <th class="text-center" rowspan="2" width="9%">+/-</th>
                                        <th class="text-center" rowspan="2" width="9%">%</th>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-center" width="9%">DINAS</th>
                                        <th class="text-center" width="9%">MPP</th>
                                        <th class="text-center" width="9%">LF</th>
                                        <th class="text-center" width="9%">SKORSING</th>
                                        <th class="text-center" width="9%">JUMLAH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">(1)</td>
                                        <td class="text-center">(2)</td>
                                        <td class="text-center">(3)</td>
                                        <td class="text-center">(4)</td>
                                        <td class="text-center">(5)</td>
                                        <td class="text-center">(6)</td>
                                        <td class="text-center">(7)</td>
                                        <td class="text-center">(8)</td>
                                        <td class="text-center">(9)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">&nbsp;</td>
                                    </tr>
                                    <?php
                                    if ($records != FALSE):
                                        $total_top = 0;
                                        $total_dinas = 0;
                                        $total_mpp = 0;
                                        $total_lf = 0;
                                        $total_skorsing = 0;
                                        $total_total = 0;
                                        ?>
                                        <?php
                                        foreach ($records['dalam'] as $key => $record):
                                            $sub_top = 0;
                                            $sub_dinas = 0;
                                            $sub_mpp = 0;
                                            $sub_lf = 0;
                                            $sub_skorsing = 0;
                                            $sub_total = 0;
                                            ?>
                                            <tr>
                                                <td><b><u><?php echo beautify_str($key) ?></u></b></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php foreach ($record as $row): ?>
                                                <?php
                                                $total = $row->dinas + $row->mpp + $row->lf + $row->skorsing;
                                                $sub_top += $row->top;
                                                $sub_dinas += $row->dinas;
                                                $sub_mpp += $row->mpp;
                                                $sub_lf += $row->lf;
                                                $sub_skorsing += $row->skorsing;
                                                $sub_total += $total;
                                                ?>
                                                <tr>
                                                    <td><?php echo beautify_str($row->ur_pangkat) ?></td>
                                                    <td align="right"><?php echo number_format($row->top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->dinas, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->mpp, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->lf, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->skorsing, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total - $row->top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($row->top == 0 ? 0 : $total / $row->top * 100, 2, ",", ".") ?>%</td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            $total_top += $sub_top;
                                            $total_dinas += $sub_dinas;
                                            $total_mpp += $sub_mpp;
                                            $total_lf += $sub_lf;
                                            $total_skorsing += $sub_skorsing;
                                            $total_total += $sub_total;
                                            ?>
                                            <tr>
                                                <td><b>JUMLAH <?php echo beautify_str($key) ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_top, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_dinas, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_mpp, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_lf, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_skorsing, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_total, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_total - $sub_top, 0, ",", ".") ?></b></td>
                                                <td align="right"><b><?php echo number_format($sub_top == 0 ? 0 : $sub_total / $sub_top * 100, 2, ",", ".") ?>%</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="9">&nbsp;</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><b>JUMLAH BESAR</b></td>
                                            <td align="right"><b><?php echo number_format($total_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_dinas, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_mpp, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_lf, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_skorsing, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_total, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_total - $total_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($total_top == 0 ? 0 : $total_total / $total_top * 100, 2, ",", ".") ?>%</b></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9"> Kosong / Data tidak ditemukan. </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
