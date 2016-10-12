<?php
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
//var_dump($detail);exit;
$cb_jenis_diklat = isset($cb_jenis_diklat) ? $cb_jenis_diklat : FALSE;
?>

<div class="block">
    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
</div>

<div class="block">
    <div class="block">
        <p>
            Kolom ini disediakan untuk mengakomodasi keterangan tahapan Diklat Penjenjangan. Mohon perhatikan panduan singkat sbb:
        <ol>
            <li>Kotak Isian bertanda bintang <strong>*</strong> harus diisi.</li> 
            <li>Data akan diurutkan secara otomatis beradasarkan tanggal mulai.</li>
            <li>Aksi Ubah:
                <ol>
                    <li>Menghapus baris pada tabel tahapan Diklat yang akan dilakukan pengubahan.</li>
                    <li>Pastikan untuk menekan kembali tombol <strong>Tambah</strong> ketika membatalkan pengubahan data.</li>
                </ol>
            </li>
        </ol>
        </p>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Tahapan *</label>
                <div class="col-md-6 col-xs-12">
                    <input id="txt-tahapan" type="text" name="txt_tahapan" class="form-control" value="">
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Tgl. Mulai Tahapan *</label>
                <div class="col-md-6 col-xs-12">
                    <input id="txt-tgl_mulai_tahapan" type="text" name="txt_tgl_mulai_tahapan" class="form-control datepicker" value="">
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Tgl. Selesai Tahapan *</label>
                <div class="col-md-6 col-xs-12">
                    <input id="txt-tgl_selesai_tahapan" type="text" name="txt_tgl_selesai_tahapan" class="form-control datepicker" value="">
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Keterangan</label>
                <div class="col-md-6 col-xs-12">
                    <textarea id="txtarea-keterangan_tahapan" name="txtarea_keterangan_tahapan" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <button id="add-tahapan-diklat" type="button" class="btn-default btn pull-right">Tambah</button>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tahapan Diklat</h3>         
                </div>
                <div id="daftar-tahapan-diklat" class="panel-body">
                    <table class="table no-footer" id="DataTables_Table_tahapan_diklat">
                        <thead>
                            <tr role="row">
                                <th>
                                    Tahapan
                                </th>
                                <th width="10%">
                                    Tanggal
                                </th>
                                <th width="30%">
                                    Keterangan
                                </th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>