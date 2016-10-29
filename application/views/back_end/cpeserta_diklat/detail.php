<?php
$detail_diklat = isset($detail_diklat) ? $detail_diklat : FALSE;
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$id_diklat = isset($id_diklat) ? $id_diklat : 0;
?>

<div class="row">
    <div class="col-md-12">

        <form id="frm-daftar-peserta-diklat" partclass="<?php echo $id_diklat; ?>" enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?> <?php echo $detail_diklat->nama_diklat; ?> Angkatan <?php echo $detail_diklat->angkatan; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">NIP *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="hidden" name="id_diklat" id="txt-id_diklat" value="<?php echo $detail_diklat ? $detail_diklat->id_diklat : ""; ?>">
                            <input type="text" name="nip" id="txt-nip" class="form-control" value="<?php echo $detail ? $detail->nip : ""; ?>">                               
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">No. Kep</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="no_kep" id="txt-no_kep" class="form-control" value="<?php echo $detail ? $detail->no_kep : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Gelar Depan</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="gelar_depan" id="txt-gelar_depan" class="form-control" value="<?php echo $detail ? $detail->gelar_depan : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Depan *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="nama_depan" id="txt-nama_depan" class="form-control" value="<?php echo $detail ? $detail->nama_depan : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Tengah</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="nama_tengah" id="txt-nama_tengah" class="form-control" value="<?php echo $detail ? $detail->nama_tengah : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Belakang *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="nama_belakang" id="txt-nama_belakang" class="form-control" value="<?php echo $detail ? $detail->nama_belakang : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Gelar Belakang</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="gelar_belakang" id="txt-gelar_belakang" class="form-control" value="<?php echo $detail ? $detail->gelar_belakang : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tempat Lahir *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="tempat_lahir" id="txt-tempat_lahir" class="form-control" value="<?php echo $detail ? $detail->tempat_lahir : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tgl. Lahir *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input id="txt-tgl_lahir" type="text" name="tgl_lahir" class="form-control datepicker" value="<?php echo $detail ? $detail->tgl_lahir : ""; ?>">
                            </div>                                            
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">SKPD *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="slc-skpd" class="form-control select2-basic" name="id_skpd">
                            </select>
                            <span class="help-block">Pilih SKPD Saat ini.<br />Masukkan kata kunci pada kotak inputan kemudian pilih SKPD yang dimaksud.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Jabatan *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="slc-jabatan" class="form-control select2-basic" name="id_jabatan">
                            </select>
                            <span class="help-block">Pilih Jabatan Saat ini.<br />Masukkan kata kunci pada kotak inputan kemudian pilih Jabatan yang dimaksud.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Golongan *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="slc-golongan" class="form-control select2-basic" name="id_golongan">
                            </select>
                            <span class="help-block">Pilih Golongan Saat ini.<br />Masukkan kata kunci pada kotak inputan kemudian pilih Golongan yang dimaksud.</span>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/" . $active_modul . "/index")."/".($detail_diklat ? $detail_diklat->id_diklat_crypted : 0); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>