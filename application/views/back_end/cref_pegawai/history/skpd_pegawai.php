<?php
$records_riwayat_pegawai_jabatan = isset($records_riwayat_pegawai_jabatan) ? $records_riwayat_pegawai_jabatan : FALSE;
$keyword_riwayat_pegawai_jabatan = isset($keyword_riwayat_pegawai_jabatan) ? $keyword_riwayat_pegawai_jabatan : FALSE;
$field_id_riwayat_pegawai_jabatan = isset($field_id_riwayat_pegawai_jabatan) ? $field_id_riwayat_pegawai_jabatan : FALSE;
$paging_set_riwayat_pegawai_jabatan = isset($paging_set_riwayat_pegawai_jabatan) ? $paging_set_riwayat_pegawai_jabatan : FALSE;
$active_modul = isset($active_modul) ? $active_modul : 'none';
$next_list_number_riwayat_pegawai_jabatan = isset($next_list_number_riwayat_pegawai_jabatan) ? $next_list_number_riwayat_pegawai_jabatan : 1;
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
                            <input type="text" name="keyword" value="<?php echo $keyword_riwayat_pegawai_jabatan; ?>" class="form-control" placeholder="Silahkan masukkan kata kunci disini"/>
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
                                <th>
                                    No
                                </th>
                                <th>
                                    Jabatan
                                </th>
                                <th>
                                    SKPD
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($records_riwayat_pegawai_jabatan != FALSE): ?>
                                <?php foreach ($records_riwayat_pegawai_jabatan as $key => $record): ?>
                                    <tr>
                                        <td>
                                            <?php echo $next_list_number_riwayat_pegawai_jabatan; ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->jabatan); ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->nama_skpd); ?>
                                        </td>
                                    </tr>
                                    <?php $next_list_number_riwayat_pegawai_jabatan++; ?>
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
                    echo $paging_set_riwayat_pegawai_jabatan;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>