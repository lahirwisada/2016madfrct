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
                                <option value="9">KEKUATAN SATOP/SATDUKOP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-md-3 control-label">TAHUN LAPORAN</label>
                        <div class="col-xs-12 col-md-6">
                            <input type="text" name="tahun" class="form-control" placeholder="MASUKKAN TAHUN LAPORAN">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-md-3 control-label">BULAN LAPORAN</label>
                        <div class="col-xs-12 col-md-6">
                            <select name="bulan" class="form-control">
                                <option value="">PILIH BULAN LAPORAN</option>
                                <option value="1">JANUARI</option>
                                <option value="2">FEBRUARI</option>
                                <option value="3">MARET</option>
                                <option value="4">APRIL</option>
                                <option value="5">MEI</option>
                                <option value="6">JUNI</option>
                                <option value="7">JULI</option>
                                <option value="8">AGUSTUS</option>
                                <option value="9">SEPTEMBER</option>
                                <option value="10">OKTOBER</option>
                                <option value="11">NOVEMBER</option>
                                <option value="12">DESEMBER</option>
                            </select>
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