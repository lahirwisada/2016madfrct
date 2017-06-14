<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
//$next_list_number = isset($next_list_number) ? $next_list_number : 1;
//var_dump($records["tingkat"]);
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
                <?php if ($records["kategori"] != FALSE): ?>
                    <div class="block">
                        <div class="text-center" style="font-weight: bold;">REKAPITULASI PA, BA, TA PERKECABANGAN</div>
                        <div class="text-center" style="font-weight: bold;">TRIWULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                    </div>
                    <div class="block">
                        <div class="dataTables_wrapper no-footer">
                            <div class="table-responsive">
                                <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                    <thead>
                                        <tr role="row">
                                            <th class="text-center" rowspan="2">NO</th>
                                            <th class="text-center" rowspan="2">KECAB</th>
                                            <th class="text-center" colspan="3">PERWIRA</th>
                                            <th class="text-center" colspan="3">BINTARA</th>
                                            <th class="text-center" colspan="3">TAMTAMA</th>
                                            <th class="text-center" colspan="3">JUMLAH</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="text-center" width="6%">TOP</th>
                                            <th class="text-center" width="6%">NYATA</th>
                                            <th class="text-center" width="6%">+/-</th>
                                            <th class="text-center" width="6%">TOP</th>
                                            <th class="text-center" width="6%">NYATA</th>
                                            <th class="text-center" width="6%">+/-</th>
                                            <th class="text-center" width="6%">TOP</th>
                                            <th class="text-center" width="6%">NYATA</th>
                                            <th class="text-center" width="6%">+/-</th>
                                            <th class="text-center" width="6%">TOP</th>
                                            <th class="text-center" width="6%">NYATA</th>
                                            <th class="text-center" width="6%">+/-</th>
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
                                        $perwira_top = 0;
                                        $perwira_nyata = 0;
                                        $bintara_top = 0;
                                        $bintara_nyata = 0;
                                        $tamtama_top = 0;
                                        $tamtama_nyata = 0;
                                        ?>
                                        <?php foreach ($records["kategori"] as $record): ?>
                                            <tr>
                                                <td align="right"><?php echo $next_list_number++ ?></td>
                                                <td><?php echo beautify_str($record["corps"]) ?></td>
                                                <td align="right"><?php echo number_format($record["perwira_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["perwira_nyata"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["perwira_nyata"] - $record["perwira_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["bintara_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["bintara_nyata"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["bintara_nyata"] - $record["bintara_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["tamtama_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["tamtama_nyata"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["tamtama_nyata"] - $record["tamtama_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["perwira_top"] + $record["bintara_top"] + $record["tamtama_top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($record["perwira_nyata"] + $record["bintara_nyata"] + $record["tamtama_nyata"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format(($record["perwira_nyata"] + $record["bintara_nyata"] + $record["tamtama_nyata"]) - ($record["perwira_top"] + $record["bintara_top"] + $record["tamtama_top"]), 0, ",", ".") ?></td>
                                            </tr>
                                            <?php
                                            $perwira_top += $record["perwira_top"];
                                            $perwira_nyata += $record["perwira_nyata"];
                                            $bintara_top += $record["bintara_top"];
                                            $bintara_nyata += $record["bintara_nyata"];
                                            $tamtama_top += $record["tamtama_top"];
                                            $tamtama_nyata += $record["tamtama_nyata"];
                                            ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td><b>JUMLAH</b></td>
                                            <td align="right"><b><?php echo number_format($perwira_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($perwira_nyata, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($perwira_nyata - $perwira_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($bintara_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($bintara_nyata, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($bintara_nyata - $bintara_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($tamtama_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($tamtama_nyata, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($tamtama_nyata - $tamtama_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($perwira_top + $bintara_top + $tamtama_top, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format($perwira_nyata + $bintara_nyata + $tamtama_nyata, 0, ",", ".") ?></b></td>
                                            <td align="right"><b><?php echo number_format(($perwira_nyata + $bintara_nyata + $tamtama_nyata) - ($perwira_top + $bintara_top + $tamtama_top), 0, ",", ".") ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!--Rekapitulasi Berdasarkan Pati-->
                <?php if ($records["tingkat"] != FALSE): ?>
                    <?php foreach ($records["tingkat"] as $tingkat => $data) : ?>
                        <?php
                        $next_list_number = 1;
                        $jumlah_pangkat = count($data["pangkat"]);
                        $lebar = round(70 / $jumlah_pangkat / 3);
                        $total_top = 0;
                        $total_nyata = 0;
                        ?>
                        <div class="block">
                            <div class="text-center" style="font-weight: bold;">REKAPITULASI <?php echo strtoupper($tingkat) ?> PERKECABANGAN</div>
                            <div class="text-center" style="font-weight: bold;">TRIWULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                        </div>
                        <div class="block">
                            <div class="dataTables_wrapper no-footer">
                                <div class="table-responsive">
                                    <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                        <thead>
                                            <tr role="row">
                                                <th class="text-center" rowspan="2">NO</th>
                                                <th class="text-center" rowspan="2">KECAB</th>
                                                <?php $i = 0; ?>
                                                <?php foreach ($data["pangkat"] as $pangkat) : ?>
                                                    <th class = "text-center" colspan = "3"><?php echo strtoupper($pangkat); ?></th>
                                                    <?php
                                                    ${"col" . (2 * $i + 1)} = strtolower($pangkat . "_top");
                                                    ${"col" . (2 * $i + 2)} = strtolower($pangkat . "_nyata");
                                                    ${"sub" . (2 * $i + 1)} = 0;
                                                    ${"sub" . (2 * $i + 2)} = 0;
                                                    $i++;
                                                    ?>
                                                <?php endforeach; ?>
                                                <th class = "text-center" colspan = "3">TOTAL</th>
                                            </tr>
                                            <tr>
                                                <?php for ($i = 0; $i <= $jumlah_pangkat; $i++) : ?>
                                                    <th class="text-center" width="<?php echo $lebar ?>%">TOP</th>
                                                    <th class="text-center" width="<?php echo $lebar ?>%">NYATA</th>
                                                    <th class="text-center" width="<?php echo $lebar ?>%">+/-</th>
                                                <?php endfor; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            ?>
                                            <?php foreach ($data["data"] as $record) : ?>
                                                <?php
                                                $sub_top = 0;
                                                $sub_nyata = 0;
//                                                var_dump($record);
                                                ?>
                                                <tr>
                                                    <td align="right"><?php echo $next_list_number++ ?></td>
                                                    <td><?php echo beautify_str($record["corps"]) ?></td>
                                                    <?php for ($i = 1; $i <= ($jumlah_pangkat * 2); $i++): ?>
                                                        <td align="right"><?php echo number_format($record[${"col" . $i}], 0, ",", ".") ?></td>
                                                        <?php if (($i % 2) == 0) { ?>
                                                            <td align="right"><?php echo number_format($record[${"col" . $i}] - $record[${"col" . ($i - 1)}], 0, ",", ".") ?></td>
                                                            <?php
                                                            $sub_nyata += $record[${"col" . $i}];
                                                        } else {
                                                            $sub_top += $record[${"col" . $i}];
                                                        }
                                                        ?>
                                                        <?php ${"sub" . $i} += $record[${"col" . $i}]; ?>
                                                    <?php endfor; ?>
                                                    <td align="right"><?php echo number_format($sub_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($sub_nyata, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($sub_nyata - $sub_top, 0, ",", ".") ?></td>
                                                    <?php
                                                    $total_top += $sub_top;
                                                    $total_nyata += $sub_nyata;
                                                    ?>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr style="font-weight: bold;">
                                                <td>&nbsp;</td>
                                                <td>JUMLAH</td>
                                                <?php for ($i = 1; $i <= ($jumlah_pangkat * 2); $i++): ?>
                                                    <td align="right"><?php echo number_format(${"sub" . $i}, 0, ",", ".") ?></td>
                                                    <?php if (($i % 2) == 0) { ?>
                                                        <td align="right"><?php echo number_format(${"sub" . $i} - ${"sub" . ($i - 1)}, 0, ",", ".") ?></td>
                                                    <?php } ?>
                                                <?php endfor; ?>
                                                <td align="right"><?php echo number_format($total_top, 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($total_nyata, 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($total_nyata - $total_top, 0, ",", ".") ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
