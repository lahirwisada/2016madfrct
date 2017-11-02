<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
?>
<div class="row">
    <div class="col-md-12">

        <!--Rekapitulasi Berdasarkan Kategori-->

        <?php if ($records['golongan'] != FALSE): ?>
            <div class="panel panel-default tabs">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $header_title; ?></h3>
                    <a class="btn btn-primary pull-right" href="<?php echo base_url() . 'back_end/lpsatkowil/export/' . $bulan . '/' . $tahun ?>">Export to Excel</a>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-rekap" role="tab" data-toggle="tab">REKAPITULASI</a></li>
                    <?php foreach ($records['detail'] as $kotama => $data): ?>
                        <li><a href="#tab-<?php echo strtolower(str_replace('/', '', str_replace(' ', '_', $kotama))) ?>" role="tab" data-toggle="tab"><?php echo strtoupper($kotama); ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-rekap">
                        <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PERSONEL SATKOWIL DAN SATINTEL</div>
                        <div class="text-center" style="font-weight: bold;">BULAN <?php echo strtoupper(array_month($bulan)) ?> TAHUN <?php echo $tahun ?></div>
                        <br>
                        <div class="table-responsive">
                            <table class="table no-footer table-bordered table-condensed table-striped">
                                <thead>
                                    <tr role="row">
                                        <th class="text-center" width="5%">NO</th>
                                        <th class="text-center" width="30%">KOTAMA/GOL</th>
                                        <th class="text-center" width="10%">DSP</th>
                                        <th class="text-center" width="10%">NYATA</th>
                                        <th class="text-center" width="10%">+/-</th>
                                        <th class="text-center" width="10%">%</th>
                                        <th class="text-center" width="10%">KET</th>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">6</th>
                                        <th class="text-center">&nbsp;</th>
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
                                    $pns_top = 0;
                                    $pns_nyata = 0;
                                    $total_top = 0;
                                    $total_nyata = 0;
                                    ?>
                                    <?php foreach ($records['golongan'] as $kotama => $record): ?>
                                        <?php
                                        $mulai = TRUE;
                                        $sub_top = 0;
                                        $sub_nyata = 0;
                                        foreach ($record as $row) :
                                            ?>
                                            <?php if ($mulai): ?>
                                                <tr>
                                                    <td align = "right"><?php echo $mulai ? $next_list_number++ : '' ?></td>
                                                    <td><?php echo $mulai ? beautify_str($kotama) : '' ?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><?php echo beautify_str($row['golongan']) ?></td>
                                                <td align="right"><?php echo number_format($row["top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($row["nyata"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo number_format($row["nyata"] - $row["top"], 0, ",", ".") ?></td>
                                                <td align="right"><?php echo $row["top"] > 0 ? number_format($row["nyata"] / $row["top"] * 100, 1, ",", ".") : 0 ?>%</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
                                            $mulai = FALSE;
                                            $sub_top += $row["top"];
                                            $sub_nyata += $row["nyata"];
                                            ${strtolower($row['golongan']) . "_top"} += $row["top"];
                                            ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];
                                            ?>
                                        <?php endforeach; ?>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td><?php echo beautify_str('JUMLAH') ?></td>
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
                                        <td>JUMLAH PERGOLONGAN</td>
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
                                        <td>PNS</td>
                                        <td align="right"><?php echo number_format($pns_top, 0, ",", ".") ?></td>
                                        <td align="right"><?php echo number_format($pns_nyata, 0, ",", ".") ?></td>
                                        <td align="right"><?php echo number_format($pns_nyata - $pns_top, 0, ",", ".") ?></td>
                                        <td align="right"><?php echo $pns_top > 0 ? number_format($pns_nyata / $pns_top * 100, 1, ",", ".") : 0 ?>%</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
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
                <?php endif; ?>
                <?php if ($records['detail'] != FALSE): ?>
                    <?php foreach ($records['detail'] as $kotama => $datas): ?>
                        <?php
//                        var_dump($datas['SATKOWIL']['KODIM 0201 BS']);
//                        exit();
                        ?>

                        <div class="tab-pane" id="tab-<?php echo strtolower(str_replace('/', '', str_replace(' ', '_', $kotama))) ?>">
                            <div class="text-center" style="font-weight: bold;">DATA KEKUATAN PERSONEL SATKOWIL DAN SATINTEL <?php echo beautify_str($kotama) ?></div>
                            <div class="text-center" style="font-weight: bold;">BULAN <?php echo strtoupper(array_month($bulan)) ?> TAHUN <?php echo $tahun ?></div>
                            <br>
                            <div class="table-responsive">
                                <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                    <thead>
                                        <tr role="row">
                                            <th class="text-center" width="5%">NO</th>
                                            <th class="text-center" width="30%">KESATUAN</th>
                                            <th class="text-center" width="15%">GOLONGAN</th>
                                            <th class="text-center" width="10%">TOP</th>
                                            <th class="text-center" width="10%">NYATA</th>
                                            <th class="text-center" width="10%">+/-</th>
                                            <th class="text-center" width="10%">%</th>
                                            <th class="text-center" width="10%">JUMLAH DESA</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                            <th class="text-center">6</th>
                                            <th class="text-center">7</th>
                                            <th class="text-center">8</th>
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
                                        </tr>
                                        <?php
                                        $next_list_number = 1;
                                        $pa_top = 0;
                                        $pa_nyata = 0;
                                        $ba_top = 0;
                                        $ba_nyata = 0;
                                        $ta_top = 0;
                                        $ta_nyata = 0;
                                        $pns_top = 0;
                                        $pns_nyata = 0;
                                        $total_top = 0;
                                        $total_nyata = 0;
                                        ?>
                                        <?php foreach ($datas as $kesatuan => $data): ?>
                                            <tr style="font-weight: bold;">
                                                <td>&nbsp;</td>
                                                <td><?php echo $kesatuan; ?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php foreach ($data as $satminkal => $record): ?>
                                                <?php
                                                $mulai = TRUE;
                                                $is_korem = substr(strtolower($satminkal), 0, 5) == 'korem';
                                                $under_korem = strpos(strtolower($satminkal), 'rem') != FALSE ? TRUE : FALSE;
                                                $sub_top = 0;
                                                $sub_nyata = 0;
                                                ?>
                                                <?php foreach ($record as $row) : ?>
                                                    <?php if ($is_korem && $mulai): ?>
                                                        <tr>
                                                            <td align = "right"><?php echo $next_list_number++ ?></td>
                                                            <td><?php echo beautify_str($satminkal) ?></td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td align = "right"><?php echo $mulai && $under_korem == FALSE ? $next_list_number++ : '' ?></td>
                                                        <td><?php echo $mulai ? $is_korem != FALSE ? 'MAKOREM' : beautify_str($satminkal) : '' ?></td>
                                                        <td><?php echo beautify_str($row['golongan']) ?></td>
                                                        <td align="right"><?php echo number_format($row["top"] - $row["danramil_top"] - $row["babinsa_top"], 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($row["nyata"], 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($row["nyata"] - $row["top"], 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo $row["top"] > 0 ? number_format($row["nyata"] / $row["top"] * 100, 1, ",", ".") : 0 ?>%</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <?php if ($row['babinsa'] == 1): ?>
                                                        <?php if ($row['danramil_top'] > 0 || $row['danramil_nyata'] > 0): ?>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Danramil</td>
                                                                <td align="right"><?php echo number_format($row["danramil_top"], 0, ",", ".") ?></td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php if ($row['babinsa_top'] > 0 || $row['babinsa_nyata'] > 0): ?>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Babinsa</td>
                                                                <td align="right"><?php echo number_format($row["babinsa_top"], 0, ",", ".") ?></td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td><?php echo number_format($row["babinsa_top"], 0, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php
                                                    $mulai = FALSE;
                                                    $sub_top += $row["top"];
                                                    $sub_nyata += $row["nyata"];
                                                    ${strtolower($row['golongan']) . "_top"} += $row["top"];
                                                    ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];
                                                    ?>
                                                <?php endforeach; ?>
                                                <tr style="font-weight: bold;">
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td><?php echo beautify_str('JML') ?></td>
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
                                                    <td>&nbsp;</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>REKAPITULASI</td>
                                            <td>PA</td>
                                            <td align="right"><?php echo number_format($pa_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($pa_nyata, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($pa_nyata - $pa_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo $pa_top > 0 ? number_format($pa_nyata / $pa_top * 100, 1, ",", ".") : 0 ?>%</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
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
                                            <td>&nbsp;</td>
                                            <td>PNS</td>
                                            <td align="right"><?php echo number_format($pns_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($pns_nyata, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo number_format($pns_nyata - $pns_top, 0, ",", ".") ?></td>
                                            <td align="right"><?php echo $pns_top > 0 ? number_format($pns_nyata / $pns_top * 100, 1, ",", ".") : 0 ?>%</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>JML</td>
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
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">                                
                    <h3 class="panel-title"><?php echo $header_title; ?></h3>
                </div>
                <div class="panel-body">
                    Belum ada data...
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
