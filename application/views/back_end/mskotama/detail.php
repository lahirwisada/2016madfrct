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
                        <label class="col-md-3 col-xs-12 control-label">Kode Kotama *</label>
                        <div class="col-md-6 col-xs-12">
                                <input type="text" name="kode_kotama" class="form-control" value="<?php echo $detail ? $detail->kode_kotama : ""; ?>">                                   
                            <span class="help-block">Isikan sesuai dengan kode kotama.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">UR Kotama *</label>
                        <div class="col-md-6 col-xs-12">
                                <input type="text" name="ur_kotama" class="form-control" value="<?php echo $detail ? $detail->ur_kotama : ""; ?>">                                        
                            <span class="help-block">Isikan sesuai dengan UR kotama.</span>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/".$active_modul."/index"); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>