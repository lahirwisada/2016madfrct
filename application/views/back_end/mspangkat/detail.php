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
                    <h3 class="panel-title">Detail <strong><?php echo $header_title; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kode Pangkat *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="kode_pangkat" class="form-control" value="<?php echo $detail ? $detail->kode_pangkat : ""; ?>">
                            </div>
                            <span class="help-block">Isikan sesuai dengan kode pangkat.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Uraian Pangkat *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="ur_pangkat" class="form-control" value="<?php echo $detail ? $detail->ur_pangkat : ""; ?>">
                            </div>
                            <span class="help-block">Isikan sesuai dengan uraian pangkat.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kelompok *</label>
                        <div class="col-md-6 col-xs-12">
                            <select name="id_kelompok" id="slc-kelompok" class="form-control select2-basic">
                            </select>
                            <span class="help-block">Isikan sesuai dengan kelompok.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Golongan *</label>
                        <div class="col-md-6 col-xs-12">        
                            <select name="id_golongan" id="slc-golongan" class="form-control select2-basic">
                            </select>
                            <span class="help-block">Isikan sesuai dengan kategori.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tingkat *</label>
                        <div class="col-md-6 col-xs-12">        
                            <select name="id_tingkat" id="slc-tingkat" class="form-control select2-basic">
                            </select>
                            <span class="help-block">Isikan sesuai dengan tingkat.</span>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Simpan</button>
                    <a href="<?php echo base_url("back_end/" . $active_modul . "/index"); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>