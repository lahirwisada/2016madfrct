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
        <label class="col-md-3 col-xs-12 control-label">Tgl. SPT</label>
        <div class="col-md-6 col-xs-12">                                            
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                <input id="txt-tgl_sttpp" type="text" name="tgl_sttpp" class="form-control datepicker" value="<?php echo $detail ? $detail->tgl_sttpp : ""; ?>">
            </div>                                            
            <span class="help-block">Tanggal SPT dibuat</span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label">Penanda Tangan</label>
        <div class="col-md-6 col-xs-12">
            <select id="slc-ttd_sttpp" class="form-control select2-basic" style="width: 100%;" name="id_ref_ttd_sttpp">
            </select>
            <span class="help-block">Pilih penandatangan STTPP.<br />Masukkan kata kunci pada kotak inputan kemudian pilih penanda tangan.</span>
        </div>
    </div>

</div>