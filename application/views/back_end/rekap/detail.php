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
                    <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">


                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Bulan *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="slc-bulan" class="form-control select2-basic" name="id_bulan">
                            </select>
                            <span class="help-block">Pilih Bulan.<br />Masukkan kata kunci pada kotak inputan kemudian pilih bulan yang dimaksud.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tahun *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="id_tahun" id="txt-id_tahun" class="form-control" value="<?php echo $detail ? $detail->id_tahun : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tgl. Upload *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input id="txt-tanggal_upload" type="text" name="tanggal_upload" class="form-control datepicker" value="<?php echo $detail ? $detail->tanggal_upload : ""; ?>">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tgl. TTD</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input id="txt-tanggal_ttd" type="text" name="tanggal_ttd" class="form-control datepicker" value="<?php echo $detail ? $detail->tanggal_ttd : ""; ?>">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Uraian Atas TTD</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="uraian_atas_ttd" id="txt-uraian_atas_ttd" class="form-control" value="<?php echo $detail ? $detail->uraian_atas_ttd : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Jabatan TTD</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="jabatan_ttd" id="txt-jabatan_ttd" class="form-control" value="<?php echo $detail ? $detail->jabatan_ttd : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Penandatangan</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="nama_ttd" id="txt-nama_ttd" class="form-control" value="<?php echo $detail ? $detail->nama_ttd : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Pangkat Penandatangan</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="pangkat_ttd" id="txt-pangkat_ttd" class="form-control" value="<?php echo $detail ? $detail->pangkat_ttd : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">NRP Penandatangan</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="nrp_ttd" id="txt-nrp_ttd" class="form-control" value="<?php echo $detail ? $detail->nrp_ttd : ""; ?>">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div class="col-md-6 col-xs-12">Upload Excel Sesuai Format.</div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Berkas Excel *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="file" name="berkas_excel" id="txt-file_excel" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/" . $active_modul . "/index") . "/" . ($detail_diklat ? $detail_diklat->id_diklat_crypted : 0); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>