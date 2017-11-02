<?php
$header_title = isset($header_title) ? $header_title : '';
?>
<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <form enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">                                
                    <h3 class="panel-title"><?php echo $header_title; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-md-3 control-label">JENIS LAPORAN</label>
                        <div class="col-xs-12 col-md-6">
                            <select name="pilihjenis" class="form-control">
                                <option value="">PILIH JENIS LAPORAN</option>
                                <option value="1">PIRAMIDA DALAM DAN LUAR STRUKTUR</option>
                                <option value="2">KEKUATAN DALAM DAN LUAR STRUKTUR</option>
                                <option value="3">KEKUATAN KOTAMA/BALAKPUS</option>
                                <option value="4">KEKUATAN PERKECABANGAN</option>
                                <option value="5">KEKUATAN MULTIKORPS</option>
                                <option value="6">KEKUATAN SATPUR/SATBANPUR/SATPASSUS</option>
                                <option value="7">KEKUATAN SATBALAK/LEMDIKRAH</option>
                                <option value="8">KEKUATAN SATKOWIL/SATINTEL</option>
                                <!--<option value="9">KEKUATAN SATOP/SATDUKOP</option>-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-md-3 control-label">TAHUN LAPORAN</label>
                        <div class="col-xs-12 col-md-6">
                            <?php
                            echo dropdown_tahun('tahun', date("Y"), 5, 'class="form-control" placeholder="MASUKKAN TAHUN LAPORAN"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-md-3 control-label">BULAN LAPORAN</label>
                        <div class="col-xs-12 col-md-6">
                            <?php echo form_dropdown('bulan', array_month(), set_value('bulan', date("n")), 'class="form-control" style="text-transform: uppercase;"'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-offset-3 col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">PROSES</button>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="panel-footer">&nbsp;</div>
            </div>
        </form>
    </div>
</div>