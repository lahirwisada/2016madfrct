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
                        <label class="col-md-3 col-xs-12 control-label">Provinsi *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="slc-provinsi" class="form-control select2-basic" name="id_provinsi">
                            </select>
                            <span class="help-block">Pilih Provinsi.<br />Masukkan kata kunci pada kotak inputan kemudian pilih provinsi yang dimaksud.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kode Kota *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="kode_kabupaten" class="form-control" value="<?php echo $detail ? $detail->kode_kabupaten : ""; ?>">
                            <span class="help-block">Isikan sesuai dengan kode kabupaten / kota yang tertera pada Ketetapan Kementerian Dalam Negeri tentang Wilayah Indonesia.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kabupaten / Kota *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="nama_kabupaten" class="form-control" value="<?php echo $detail ? $detail->nama_kabupaten : ""; ?>">                      
                            <span class="help-block">
                                Nama Kabupaten / Kota.
                                <br />contoh 1 : KOTA TANGERANG SELATAN
                                <br />contoh 2 : KAB. TANGERANG
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Ibukota Provinsi</label>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" name="is_ibukota" class="icheckbox" <?php echo $detail && $detail->is_ibukota ? "checked=\"checked\"" : ""; ?>> Ibukota Provinsi</label>
                            <span class="help-block">
                                Centang jika kota ini adalah ibukota Provinsi.
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Keterangan</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="keterangan" class="form-control" value="<?php echo $detail ? $detail->keterangan : ""; ?>">                      
                            <span class="help-block">
                                Isikan Seperlunya.
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