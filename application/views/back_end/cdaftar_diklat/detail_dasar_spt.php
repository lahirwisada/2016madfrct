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
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Dasar</label>
                <div class="col-md-6 col-xs-12">
                    <input id="txt-dasar" type="text" name="txt_dasar" class="form-control" value="">
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button id="add-dasar-spt" type="button" class="btn-default btn pull-right">Tambah</button>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Daftar Dasar SPT</h3>         
        </div>
        <div id="daftar-dasar" class="panel-body list-group list-group-contacts">                                
            <?php if ($detail && $detail->spt_dasar != NULL): ?>
                <?php foreach ($detail->spt_dasar as $spt_dasar): ?>
                    <a href="javascript:void(0);" class="list-group-item">
                        <p><span class="list-title-dasar"><?php echo $spt_dasar; ?></span> <button class="btn-remove-list btn btn-sm btn-default pull-right"><span class="fa fa-trash-o"></span></button></p>
                        <input type="hidden" class="inp-spt-dasar" name="spt_dasar[]" value="<?php echo $spt_dasar; ?>">
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>