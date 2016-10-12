<?php
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
?>

<div class="row">
    <div class="col-md-12">

        <form enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">SKPD *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="slc-skpd" class="form-control select2-basic" name="id_skpd">
                            </select>
                            <span class="help-block">Pilih SKPD.<br />Masukkan kata kunci pada kotak inputan kemudian pilih SKPD yang dimaksud.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Pegawai *</label>
                        <div class="col-md-6 col-xs-12">
                            <select id="slc-pegawai" class="form-control select2-basic" name="id_pegawai">
                            </select>
                            <span class="help-block">Pilih pegawai penandatangan.<br />Masukkan kata kunci (NIP / Nama pegawai) pada kotak inputan kemudian pilih Pegawai yang dimaksud.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Jabatan</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="jabatan_ttd" class="form-control" value="<?php echo $detail ? $detail->jabatan_ttd : ""; ?>">
                            <span class="help-block">
                                Masukkan jabatan pegawai penandatangan.
                                <br />Maksud dari inputan ini adalah membantu ketika pegawai yang terpilih belum memperbarui data jabatannya, sehingga pada pencetakan SPT pada bagian penandatangan tidak ada kesalahan penulisan Jabatan.
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Uraian Atas TTD</label>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="text" name="uraian_atas_ttd" class="form-control" value="<?php echo $detail ? $detail->uraian_atas_ttd : ""; ?>">
                            <span class="help-block">
                                Kosongkan jika tidak diperlukan.
                                <br />
                                contoh : an. Pimpinan
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Uraian Bawah TTD</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="uraian_bawah_ttd" class="form-control" value="<?php echo $detail ? $detail->uraian_bawah_ttd : ""; ?>">                      
                            <span class="help-block">
                                Kosongkan jika tidak diperlukan.
                                <br />
                                contoh : Selaku Penyelenggara Diklat
                            </span>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/" . $active_modul . "/index"); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>