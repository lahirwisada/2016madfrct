<?php
$header_title = isset($header_title) ? $header_title : '';
$records = isset($records) ? $records : FALSE;
$active_modul = isset($active_modul) ? $active_modul : 'none';
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
?>
<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">                                
                <h3 class="panel-title">Hasil <strong><?php echo $header_title; ?></strong></h3>
            </div>
            <div class="panel-body">

<!--                <div class="block">
                    <?php echo load_partial("back_end/shared/attention_message"); ?>
                </div>-->
                <div class="block">
                    <?php if ($records != FALSE): ?>
                        <?php foreach ($records as $key => $data) : ?>
                            <div><?php echo "Kesatuan : " . beautify_str($key) ?></div>
                            <?php $next_list_number = 1; ?>
                            <div class="dataTables_wrapper no-footer">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-striped no-footer" id="DataTables_Table_0">
                                        <thead>
                                            <tr role="row">
                                                <th class="text-center">NO</th>
                                                <th class="text-center">PANGKAT</th>
                                                <th class="text-center" width="10%">TOP</th>
                                                <th class="text-center" width="10%">DINAS</th>
                                                <th class="text-center" width="10%">MPP</th>
                                                <th class="text-center" width="10%">LF</th>
                                                <th class="text-center" width="10%">SKORSING</th>
                                                <th class="text-center" width="10%">JUMLAH</th>
                                                <th class="text-center" width="10%">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $row): ?>
                                                <tr>
                                                    <td align="right"><?php echo $next_list_number++; ?></td>
                                                    <td><?php echo beautify_str($row->ur_pangkat); ?></td>
                                                    <td align="right"><?php echo number_format($row->top, 0, ",", "."); ?></td>
                                                    <td align="right"><?php echo number_format($row->dinas, 0, ",", "."); ?></td>
                                                    <td align="right"><?php echo number_format($row->mpp, 0, ",", "."); ?></td>
                                                    <td align="right"><?php echo number_format($row->lf, 0, ",", "."); ?></td>
                                                    <td align="right"><?php echo number_format($row->skorsing, 0, ",", "."); ?></td>
                                                    <?php $jumlah = $row->dinas + $row->mpp + $row->lf + $row->skorsing ?>
                                                    <td align="right"><?php echo number_format($jumlah, 0, ",", "."); ?></td>
                                                    <td align="right"><?php echo number_format($row->top - $jumlah, 0, ",", "."); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div>Kosong / Data tidak ditemukan...</div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>
</div>
