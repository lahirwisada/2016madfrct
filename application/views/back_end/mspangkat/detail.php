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
                        <label class="col-md-3 col-xs-12 control-label">Kode Pangkat *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <input type="text" name="kode_pangkat" class="form-control" value="<?php echo $detail ? $detail->kode_pangkat : ""; ?>">
                            <span class="help-block">Isikan sesuai dengan kode pangkat.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">UR Pangkat *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <input type="text" name="ur_pangkat" class="form-control" value="<?php echo $detail ? $detail->ur_pangkat : ""; ?>">
                            <span class="help-block">Isikan sesuai dengan UR pangkat.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kategori *</label>
                        <div class="col-md-6 col-xs-12">        
                            <select name="kategori_pangkat" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <option value="1"<?php echo $detail && $detail->kategori_pangkat == 1 ? " selected" : ""; ?>>Tamtama</option>
                                <option value="2"<?php echo $detail && $detail->kategori_pangkat == 2 ? " selected" : ""; ?>>Bintara</option>
                                <option value="3"<?php echo $detail && $detail->kategori_pangkat == 3 ? " selected" : ""; ?>>Perwira</option>
                                <option value="3"<?php echo $detail && $detail->kategori_pangkat == 4 ? " selected" : ""; ?>>PNS</option>
                            </select>
                            <span class="help-block">Isikan sesuai dengan Kategori.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tingkat *</label>
                        <div class="col-md-6 col-xs-12">        
                            <select name="tingkat_pangkat" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <option value="1"<?php echo $detail && $detail->tingkat_pangkat == 1 ? " selected" : ""; ?>>Tamtama</option>
                                <option value="2"<?php echo $detail && $detail->tingkat_pangkat == 2 ? " selected" : ""; ?>>Bintara</option>
                                <option value="3"<?php echo $detail && $detail->tingkat_pangkat == 3 ? " selected" : ""; ?>>Pama</option>
                                <option value="4"<?php echo $detail && $detail->tingkat_pangkat == 4 ? " selected" : ""; ?>>Pamen</option>
                                <option value="5"<?php echo $detail && $detail->tingkat_pangkat == 5 ? " selected" : ""; ?>>Pati</option>
                                <option value="6"<?php echo $detail && $detail->tingkat_pangkat == 6 ? " selected" : ""; ?>>PNS</option>
                            </select>
                            <span class="help-block">Isikan sesuai dengan Tingkat.</span>
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