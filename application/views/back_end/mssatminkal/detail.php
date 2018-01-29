<?php
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$kotama = isset($kotama) ? $kotama : FALSE;
$kesatuan = isset($kesatuan) ? $kesatuan : FALSE;
$corps = isset($corps) ? $corps : FALSE;
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
                        <label class="col-md-3 col-xs-12 control-label">Kotama *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <?php
                            $kotamas = array();
                            $kotamas[''] = 'Pilih Kotama';
                            if ($kotama) {
                                foreach ($kotama as $row) {
                                    $kotamas[$row->id_kotama] = $row->ur_kotama;
                                }
                            }
                            echo form_dropdown('id_kotama', $kotamas, set_value('id_kotama', $detail ? $detail->id_kotama : ''), 'id="id_kotama" class="form-control select" data-live-search="true"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kode Satminkal*</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="kode_satminkal" class="form-control" value="<?php echo $detail ? $detail->kode_satminkal : ""; ?>">
                            </div>
                            <span class="help-block">Isikan sesuai dengan kode satminkal.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Satminkal*</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="ur_satminkal" class="form-control" value="<?php echo $detail ? $detail->ur_satminkal : ""; ?>">
                            </div>
                            <span class="help-block">
                                Nama Satminkal, contoh "YONIF 100/RAIDER"
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kesatuan</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <?php
                            $kesatuans = array();
                            $kesatuans[''] = 'Pilih Kesatuan';
                            if ($kesatuan) {
                                foreach ($kesatuan as $row) {
                                    $kesatuans[$row->id_kesatuan] = $row->nama_kesatuan;
                                }
                            }
                            echo form_dropdown('id_kesatuan', $kesatuans, set_value('id_kesatuan', $detail ? $detail->id_kesatuan : ''), 'id="id_kesatuan" class="form-control select" data-live-search="true"');
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Corps</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <?php
                            $corpss = array();
                            $corpss[''] = 'Pilih Kesatuan';
                            if ($corps) {
                                foreach ($corps as $row) {
                                    $corpss[$row->id_corps] = $row->ur_corps;
                                }
                            }
                            echo form_dropdown('id_corps', $corpss, set_value('id_corps', $detail ? $detail->id_corps : ''), 'id="id_corps" class="form-control select" data-live-search="true"');
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Memiliki Babinsa</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <select id="babinsa" class="form-control select" name="babinsa">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
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