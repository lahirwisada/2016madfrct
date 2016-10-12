<?php
$records_riwayat_diklat = isset($records_riwayat_diklat) ? $records_riwayat_diklat : FALSE;
$keyword_riwayat_diklat = isset($keyword_riwayat_diklat) ? $keyword_riwayat_diklat : FALSE;
$field_id_riwayat_diklat = isset($field_id_riwayat_diklat) ? $field_id_riwayat_diklat : FALSE;
$paging_set_riwayat_diklat = isset($paging_set_riwayat_diklat) ? $paging_set_riwayat_diklat : FALSE;
$active_modul = isset($active_modul) ? $active_modul : 'none';
$next_list_number_riwayat_diklat = isset($next_list_number_riwayat_diklat) ? $next_list_number_riwayat_diklat : 1;
?>
<div class="block">
    <div class="col-md-12">
        <!-- START DEFAULT DATATABLE -->

        <div class="block">
            <p>Gunakan Formulir ini untuk melakukan pencarian pada halaman ini.</p>
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-search"></span>
                            </div>
                            <input type="text" name="keyword" value="<?php echo $keyword_riwayat_diklat; ?>" class="form-control" placeholder="Silahkan masukkan kata kunci disini"/>
                            <div class="input-group-btn">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </div>
                    <!--                            <div class="col-md-4">
                                                    <a href="<?php echo base_url('back_end/' . $active_modul . '/detail'); ?>" class="btn btn-success btn-block">
                                                        <span class="fa fa-plus"></span> Tambah baru
                                                    </a>
                                                </div>-->
                </div>
            </form>
        </div>
        <div class="block">
            <div class="dataTables_wrapper no-footer">
                <div class="table-responsive">
                    <table class="table no-footer" id="DataTables_Table_0">
                        <thead>
                            <tr role="row">
                                <th colspan="1" rowspan="2">
                                    No
                                </th>
                                <th colspan="1" rowspan="2">
                                    Nama Diklat
                                </th>
                                <th colspan="1" rowspan="2">
                                    Penyelenggara Diklat
                                </th>
                                <th colspan="1" rowspan="2">
                                    Tahun
                                </th>
                                <th colspan="1" rowspan="2">
                                    Total Jam
                                </th>
                                <th  colspan="3">
                                    Pada Saat
                                </th>
                            </tr>
                            <tr>
                                <th>Gol.</th>
                                <th>Jab.</th>
                                <th>SKPD.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($records_riwayat_diklat != FALSE): ?>
                                <?php foreach ($records_riwayat_diklat as $key => $record): ?>
                                    <tr>
                                        <td>
                                            <?php echo $next_list_number_riwayat_diklat; ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->nama_diklat); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->penyelenggara); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str(show_date_with_format($record->tgl_pelaksanaan, "Y"), FALSE, "-"); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->total_jam); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->golongan); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->jabatan); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->nama_skpd); ?>
                                        </td>
                                    </tr>
                                    <?php $next_list_number_riwayat_diklat++; ?>
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
                    echo $paging_set_riwayat_diklat;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>