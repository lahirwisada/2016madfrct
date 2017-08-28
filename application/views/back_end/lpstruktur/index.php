<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
//var_dump($records['rekap']);
//exit();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Rekapitulasi</a></li>
                <li><a href="#tab-second" role="tab" data-toggle="tab">Dalam Struktur</a></li>
                <li><a href="#tab-third" role="tab" data-toggle="tab">Luar Struktur</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-first">
                    <?php if ($records['rekap']): ?>
                        <div class="block">
                            <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PERSONEL DALAM DAN LUAR STRUKTUR TNI AD</div>
                            <div class="text-center" style="font-weight: bold;">BULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                        </div>
                        <div class="block">
                            <div class="dataTables_wrapper no-footer">
                                <div class="table-responsive">
                                    <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                        <thead>
                                            <tr role="row">
                                                <th class="text-center" rowspan="2">GOLONGAN/PANGKAT</th>
                                                <th class="text-center" colspan="4">DALAM STRUKTUR</th>
                                                <th class="text-center" colspan="4">LUAR STRUKTUR</th>
                                                <th class="text-center" colspan="4">REKAPITULASI STRUKTUR</th>
                                                <th class="text-center" rowspan="2">KETERANGAN</th>
                                            </tr>
                                            <tr role="row">
                                                <th class="text-center" width="9%">TOP/DSPP</th>
                                                <th class="text-center" width="9%">NYATA</th>
                                                <th class="text-center" width="9%">+/-</th>
                                                <th class="text-center" width="9%">%</th>
                                                <th class="text-center" width="9%">TOP/DSPP</th>
                                                <th class="text-center" width="9%">NYATA</th>
                                                <th class="text-center" width="9%">+/-</th>
                                                <th class="text-center" width="9%">%</th>
                                                <th class="text-center" width="9%">TOP/DSPP</th>
                                                <th class="text-center" width="9%">NYATA</th>
                                                <th class="text-center" width="9%">+/-</th>
                                                <th class="text-center" width="9%">%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            <tr>
                                                <td class="text-center">(1)</td>
                                                <td class="text-center">(2)</td>
                                                <td class="text-center">(3)</td>
                                                <td class="text-center">(4)</td>
                                                <td class="text-center">(5)</td>
                                                <td class="text-center">(6)</td>
                                                <td class="text-center">(7)</td>
                                                <td class="text-center">(8)</td>
                                                <td class="text-center">(9)</td>
                                                <td class="text-center">(10)</td>
                                                <td class="text-center">(11)</td>
                                                <td class="text-center">(12)</td>
                                                <td class="text-center">(13)</td>
                                                <td class="text-center">(14)</td>
                                            </tr>-->
                                            <tr>
                                                <td colspan="14">&nbsp;</td>
                                            </tr>
                                            <?php
                                            if ($records != FALSE):
                                                $total_dalam_top = 0;
                                                $total_dalam_nyata = 0;
                                                $total_luar_top = 0;
                                                $total_luar_nyata = 0;
                                                $total_total_top = 0;
                                                $total_total_nyata = 0;
                                                ?>
                                                <?php
                                                foreach ($records['rekap'] as $key => $record):
                                                    $sub_dalam_top = 0;
                                                    $sub_dalam_nyata = 0;
                                                    $sub_luar_top = 0;
                                                    $sub_luar_nyata = 0;
                                                    $sub_total_top = 0;
                                                    $sub_total_nyata = 0;
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
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <?php foreach ($record as $k => $row): ?>
                                                        <?php
                                                        $dalam_top = $row['dalam_top'];
                                                        $dalam_nyata = $row['dalam_nyata'];
                                                        $luar_top = $row['luar_top'];
                                                        $luar_nyata = $row['luar_nyata'];
                                                        $total_top = $dalam_top + $luar_top;
                                                        $total_nyata = $dalam_nyata + $luar_nyata;

                                                        $sub_dalam_top += $dalam_top;
                                                        $sub_dalam_nyata += $dalam_nyata;
                                                        $sub_luar_top += $luar_top;
                                                        $sub_luar_nyata += $luar_nyata;
                                                        $sub_total_top += $total_top;
                                                        $sub_total_nyata += $total_nyata;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo beautify_str($row['pangkat']) ?></td>
                                                            <td align="right"><?php echo number_format($dalam_top, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($dalam_nyata, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($dalam_nyata - $dalam_top, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($dalam_top < 1 ? 0 : $dalam_nyata / $dalam_top * 100, 2, ",", ".") ?>%</td>
                                                            <td align="right"><?php echo number_format($luar_top, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($luar_nyata, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($luar_nyata - $luar_top, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($luar_top < 1 ? 0 : $luar_nyata / $luar_top * 100, 2, ",", ".") ?>%</td>
                                                            <td align="right"><?php echo number_format($total_top, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($total_nyata, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($total_nyata - $total_top, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($total_top < 1 ? 0 : $total_nyata / $total_top * 100, 2, ",", ".") ?>%</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                    $total_dalam_top += $sub_dalam_top;
                                                    $total_dalam_nyata += $sub_dalam_nyata;
                                                    $total_luar_top += $sub_luar_top;
                                                    $total_luar_nyata += $sub_luar_nyata;
                                                    $total_total_top += $sub_total_top;
                                                    $total_total_nyata += $sub_total_nyata;
                                                    ?>
                                                        <tr style="font-weight: bold;">
                                                        <td><b>JUMLAH <?php echo beautify_str($key) ?></b></td>
                                                        <td align="right"><?php echo number_format($sub_dalam_top, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_dalam_nyata, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_dalam_nyata - $sub_dalam_top, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_dalam_top < 1 ? 0 : $sub_dalam_nyata / $sub_dalam_top * 100, 2, ",", ".") ?>%</td>
                                                        <td align="right"><?php echo number_format($sub_luar_top, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_luar_nyata, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_luar_nyata - $sub_luar_top, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_luar_top < 1 ? 0 : $sub_luar_nyata / $sub_luar_top * 100, 2, ",", ".") ?>%</td>
                                                        <td align="right"><?php echo number_format($sub_total_top, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_total_nyata, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_total_nyata - $sub_total_top, 0, ",", ".") ?></td>
                                                        <td align="right"><?php echo number_format($sub_total_top < 1 ? 0 : $sub_total_nyata / $sub_total_top * 100, 2, ",", ".") ?>%</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="14">&nbsp;</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                    <tr style="font-weight: bold;">
                                                    <td><b>JUMLAH BESAR</b></td>
                                                    <td align="right"><?php echo number_format($total_dalam_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_dalam_nyata, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_dalam_nyata - $total_dalam_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_dalam_top < 1 ? 0 : $total_dalam_nyata / $total_dalam_top * 100, 2, ",", ".") ?>%</td>
                                                    <td align="right"><?php echo number_format($total_luar_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_luar_nyata, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_luar_nyata - $total_luar_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_luar_top < 1 ? 0 : $total_luar_nyata / $total_luar_top * 100, 2, ",", ".") ?>%</td>
                                                    <td align="right"><?php echo number_format($total_total_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_total_nyata, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_total_nyata - $total_total_top, 0, ",", ".") ?></td>
                                                    <td align="right"><?php echo number_format($total_total_top < 1 ? 0 : $total_total_nyata / $total_total_top * 100, 2, ",", ".") ?>%</td>
                                                    <td>&nbsp;</td>
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
                    <?php else : ?>
                        Belum ada data...
                    <?php endif; ?>
                </div>
                <div class="tab-pane" id="tab-second">
                    <?php if ($records['dalam']): ?>
                        <div class="block">
                            <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PERSONEL DALAM STRUKTUR TNI AD</div>
                            <div class="text-center" style="font-weight: bold;">BULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
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
<!--                                            <tr>
                                                <td class="text-center">(1)</td>
                                                <td class="text-center">(2)</td>
                                                <td class="text-center">(3)</td>
                                                <td class="text-center">(4)</td>
                                                <td class="text-center">(5)</td>
                                                <td class="text-center">(6)</td>
                                                <td class="text-center">(7)</td>
                                                <td class="text-center">(8)</td>
                                                <td class="text-center">(9)</td>
                                            </tr>-->
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
                    <?php else : ?>
                        Belum ada data...
                    <?php endif; ?>
                </div>                                        
                <div class="tab-pane" id="tab-third">
                    <?php if ($records['luar']): ?>
                        <?php $jml_kotama = count($records['luar']['kotama']); ?>
                        <div class="block">
                            <div class="text-center" style="font-weight: bold;">REKAPITULASI KEKUATAN PERSONEL LUAR STRUKTUR TNI AD</div>
                            <div class="text-center" style="font-weight: bold;">BULAN <?php echo num_to_roman($bulan) ?> TAHUN <?php echo $tahun ?></div>
                        </div>
                        <div class="block">
                            <div class="dataTables_wrapper no-footer">
                                <div class="table-responsive">
                                    <table class="table no-footer table-bordered table-condensed table-striped" id="DataTables_Table_0">
                                        <thead>
                                            <tr role="row">
                                                <th class="text-center" rowspan="2">GOLONGAN/PANGKAT</th>
                                                <th class="text-center" rowspan="2" width="9%">TOP</th>
                                                <th class="text-center" colspan="<?php echo $jml_kotama + 1; ?>">KEKUATAN NYATA</th>
                                                <th class="text-center" rowspan="2" width="9%">+/-</th>
                                                <th class="text-center" rowspan="2" width="9%">%</th>
                                            </tr>
                                            <tr role="row">
                                                <?php foreach ($records['luar']['kotama'] as $row) : ?>
                                                    <th class="text-center" width="9%"><?php echo $row; ?></th>
                                                <?php endforeach; ?>
                                                <th class="text-center" width="9%">JUMLAH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            <tr>
                                                <?php for ($i = 1; $i <= $jml_kotama + 5; $i++): ?>
                                                    <td class="text-center">(<?php echo $i; ?>)</td>
                                                <?php endfor; ?>
                                            </tr>-->
                                            <tr>
                                                <td colspan="<?php echo $jml_kotama + 5; ?>">&nbsp;</td>
                                            </tr>
                                            <?php
                                            if ($records != FALSE):
                                                $total_top = 0;
                                                $total_jml = array();
                                                $total_total = 0;
                                                ?>
                                                <?php
                                                foreach ($records['luar']['data'] as $key => $record):
                                                    $sub_top = 0;
                                                    $sub_jml = array();
                                                    $sub_total = 0;
                                                    ?>
                                                    <tr>
                                                        <td><b><u><?php echo beautify_str($key) ?></u></b></td>
                                                        <?php for ($i = 1; $i < $jml_kotama + 5; $i++): ?>
                                                            <td>&nbsp;</td>
                                                        <?php endfor; ?>
                                                    </tr>
                                                    <?php foreach ($record as $row): ?>
                                                        <tr>
                                                            <td><?php echo beautify_str($row['pangkat']) ?></td>
                                                            <td align="right"><?php echo number_format($row['top'], 0, ",", ".") ?></td>
                                                            <?php $sumrow = 0; ?>
                                                            <?php foreach ($row['jml'] as $kj => $jml): ?>
                                                                <td align="right"><?php echo number_format($jml, 0, ",", ".") ?></td>
                                                                <?php
                                                                $sumrow += $jml;
                                                                $sub_jml[$kj] = isset($sub_jml[$kj]) ? $sub_jml[$kj] + $jml : $jml;
                                                                $total_jml[$kj] = isset($total_jml[$kj]) ? $total_jml[$kj] + $jml : $jml;
                                                                ?>
                                                            <?php endforeach; ?>
                                                            <td align="right"><?php echo number_format($sumrow, 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($sumrow - $row['top'], 0, ",", ".") ?></td>
                                                            <td align="right"><?php echo number_format($row['top'] == 0 ? 0 : $sumrow / $row['top'] * 100, 2, ",", ".") ?>%</td>
                                                        </tr>
                                                        <?php
                                                        $sub_top += $row['top'];
                                                        $sub_total += $sumrow;
                                                        ?>
                                                        <?php
                                                    endforeach;
                                                    $total_top += $sub_top;
                                                    $total_total += $sub_total;
                                                    ?>
                                                    <tr>
                                                        <td><b>JUMLAH <?php echo beautify_str($key) ?></b></td>
                                                        <td align="right"><b><?php echo number_format($sub_top, 0, ",", ".") ?></b></td>
                                                        <?php foreach ($sub_jml as $value) : ?>
                                                            <td align="right"><b><?php echo number_format($value, 0, ",", ".") ?></b></td>
                                                        <?php endforeach; ?>
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
                                                    <?php foreach ($total_jml as $value) : ?>
                                                        <td align="right"><b><?php echo number_format($value, 0, ",", ".") ?></b></td>
                                                    <?php endforeach; ?>
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
                    <?php else : ?>
                        Belum ada data...
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
