<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
//$next_list_number = isset($next_list_number) ? $next_list_number : 1;
//var_dump($records);
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

                <!--Rekapitulasi Berdasarkan Kategori-->
                <?php if ($records != FALSE): ?>
                    <div class="block">
                        <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PERSONEL SATPUR, SATBANPUR DAN SATPASSUS</div>
                        <div class="text-center" style="font-weight: bold;">TRIWULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                    </div>
                    <div class="block">
                        <div class="dataTables_wrapper no-footer">
                            <div class="table-responsive">
                                <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                    <thead>
                                        <tr role="row">
                                            <th class="text-center" width="5%">NO</th>
                                            <th class="text-center" width="35%">KOTAMA/GOL</th>
                                            <th class="text-center" width="10%">TOP</th>
                                            <th class="text-center" width="10%">NYATA</th>
                                            <th class="text-center" width="10%">+/-</th>
                                            <th class="text-center" width="10%">%</th>
                                            <th class="text-center" width="20%">KET</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                            <th class="text-center">6</th>
                                            <th class="text-center">7</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <?php
                                        $next_list_number = 1;
                                        $pa_top = 0;
                                        $pa_nyata = 0;
                                        $ba_top = 0;
                                        $ba_nyata = 0;
                                        $ta_top = 0;
                                        $ta_nyata = 0;
                                        $total_top = 0;
                                        $total_nyata = 0;
                                        ?>
                                        <?php foreach ($records as $kotama => $golongans): ?>
                                            <?php
                                            $sub_top = 0;
                                            $sub_nyata = 0;
                                            ?>
                                            <tr>
                                                <td align="right"><?php echo $next_list_number++ ?></td>
                                                <td><strong><?php echo beautify_str($kotama) ?></strong></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php foreach ($golongans as $golongan => $data): ?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><?php echo beautify_str($golongan) ?></td>
                                                    <td align="right"><?php echo number_format($data["top"], 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($data["nyata"], 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($data["nyata"] - $data["top"], 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo $data["top"] > 0 ? number_format($data["nyata"] / $data["top"] * 100, 1, ",", ".") : 0 ?>%</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <?php
                                                $sub_top += $data["top"];
                                                $sub_nyata += $data["nyata"];
                                                ${strtolower($golongan) . "_top"} += $data["top"];
                                                ${strtolower($golongan) . "_nyata"} += $data["nyata"];
                                                ?>
                                            <?php endforeach; ?>
                                            <tr style="font-weight: bold;">
                                                <td>&nbsp;</td>
                                                <td>JUMLAH</td>
                                                <td align="right"><?php echo number_format($sub_top, 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($sub_nyata, 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($sub_nyata - $sub_top, 0, ",", ".") ?></td>
                                                <td align="right"><?php echo $sub_top > 0 ? number_format($sub_nyata / $sub_top * 100, 1, ",", ".") : 0 ?>%</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
                                            $total_top += $sub_top;
                                            $total_nyata += $sub_nyata;
                                            ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>REKAPITULASI</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>PA</td>
                                            <td align="right"><?php echo number_format($pa_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($pa_nyata, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($pa_nyata - $pa_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo $pa_top > 0 ? number_format($pa_nyata / $pa_top * 100, 1, ",", ".") : 0 ?>%</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>BA</td>
                                            <td align="right"><?php echo number_format($ba_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($ba_nyata, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($ba_nyata - $ba_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo $ba_top > 0 ? number_format($ba_nyata / $ba_top * 100, 1, ",", ".") : 0 ?>%</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>TA</td>
                                            <td align="right"><?php echo number_format($ta_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($ta_nyata, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($ta_nyata - $ta_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo $ta_top > 0 ? number_format($ta_nyata / $ta_top * 100, 1, ",", ".") : 0 ?>%</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>JUMLAH BESAR</td>
                                            <td align="right"><?php echo number_format($total_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($total_nyata, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($total_nyata - $total_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo $total_top > 0 ? number_format($total_nyata / $total_top * 100, 1, ",", ".") : 0 ?>%</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
