<?php
$detail = isset($detail) ? $detail : FALSE;
?>

<div class="row">
    <div class="col-md-12">

        <form enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong>Jenis Diklat</strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Jenis Diklat *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="jenis_diklat" class="form-control" value="<?php echo $detail ? $detail->jenis_diklat : ""; ?>">
                            </div>                                            
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Keterangan</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <textarea name="keterangan" class="form-control"><?php echo $detail ? $detail->keterangan : ""; ?></textarea>
                            </div>                                            
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/cjenis_diklat/index"); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>