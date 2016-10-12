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
                        <label class="col-md-3 col-xs-12 control-label">Nama SKPD *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="nama_skpd" class="form-control" value="<?php echo $detail ? $detail->nama_skpd : ""; ?>">
                            </div>                                            
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Singkatan SKPD</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="abbr_skpd" class="form-control" value="<?php echo $detail ? $detail->abbr_skpd : ""; ?>">
                            </div>                                            
                            <span class="help-block">Singkatan SKPD.<br />Gunakan singkatan SKPD sesuai dengan singkatan yang baku sesuai dengan payung hukum yang berlaku.</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Alamat</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="alamat_skpd" class="form-control" value="<?php echo $detail ? $detail->alamat_skpd : ""; ?>">
                            </div>                                            
                            <span class="help-block">Isikan dengan Alamat sesuai dengan singkatan yang baku sesuai dengan payung hukum yang berlaku.</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kode Pos</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="kodepos" class="form-control" value="<?php echo $detail ? $detail->kodepos : ""; ?>">
                            </div>                                            
                            <span class="help-block">Isikan tanpa spasi berupa angka saja, kosongkan jika belum ada.</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nomor Telp</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="no_telp" class="form-control" value="<?php echo $detail ? $detail->no_telp : ""; ?>">
                            </div>                                            
                            <span class="help-block">Isikan tanpa spasi berupa angka saja.<br />contoh 0215324325</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">E-Mail</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" value="<?php echo $detail ? $detail->email : ""; ?>">
                            </div>                                            
                            <span class="help-block">Isikan email dengan format yang benar sesuai dengan alamat email SKPD yang aktif, kosongkan jika belum ada.<br />contoh : alamatemail@kotatangerangselatan.go.id</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Website</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="website" class="form-control" value="<?php echo $detail ? $detail->website : ""; ?>">
                            </div>                                            
                            <span class="help-block">Isikan alamat website SKPD yang aktif, kosongkan jika belum ada.<br />contoh : alamatsitus.kotatangerangselatan.go.id</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">No. urut</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="text" name="col_order" class="form-control" value="<?php echo $detail ? $detail->col_order : ""; ?>">
                            </div>                                            
                            <span class="help-block">Isikan Sesuai dengan urutan yang diinginkan.<br />Isian ini digunakan untuk memudahkan pengurutan ketika menampilkan data.</span>
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