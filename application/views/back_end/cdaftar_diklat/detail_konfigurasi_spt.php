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

    <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label">Nomor SPT</label>
        <div class="col-md-6 col-xs-12">
            <div class="col-md-3">
                <input id="txt-no_spt_a" type="text" name="no_spt_a" class="form-control" value="<?php echo $detail ? $detail->no_spt_a : ""; ?>">                      
                <span class="help-block">contoh : 000</span>
            </div>
            <div class="col-md-3">
                <input id="txt-no_spt_b" type="text" name="no_spt_b" class="form-control" value="<?php echo $detail ? $detail->no_spt_b : ""; ?>">                      
                <span class="help-block">contoh : 000</span>
            </div>
            <div class="col-md-3">
                <input id="txt-no_spt_c" type="text" name="no_spt_c" class="form-control" value="<?php echo $detail ? $detail->no_spt_c : ""; ?>">                      
                <span class="help-block">contoh : SPT</span>
            </div>
            <div class="col-md-3">
                <input id="txt-no_spt_d" type="text" name="no_spt_d" class="form-control" value="<?php echo $detail ? $detail->no_spt_d : ""; ?>">                      
                <span class="help-block">contoh : DP</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label">Tgl. SPT</label>
        <div class="col-md-6 col-xs-12">                                            
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                <input id="txt-tgl_spt" type="text" name="tgl_spt" class="form-control datepicker" value="<?php echo $detail ? $detail->tgl_spt : ""; ?>">
            </div>                                            
            <span class="help-block">Tanggal SPT dibuat</span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label">Penanda Tangan</label>
        <div class="col-md-6 col-xs-12">
            <select id="slc-ttd" class="form-control select2-basic" style="width: 100%;" name="id_ref_ttd">
            </select>
            <span class="help-block">Pilih penandatangan SPT.<br />Masukkan kata kunci pada kotak inputan kemudian pilih penanda tangan.</span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label">Kepada</label>
        <div class="col-md-6 col-xs-12">
            <input id="txt-spt_kepada" type="text" name="spt_kepada" class="form-control" value="<?php echo $detail ? $detail->spt_kepada : "Mereka yang nama- namanya tercantum pada lampiran Surat Perintah Tugas ini."; ?>">                      
            <span class="help-block"></span>
        </div>
    </div>

</div>