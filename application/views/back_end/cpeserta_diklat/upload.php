<?php
$detail_diklat = isset($detail_diklat) ? $detail_diklat : FALSE;
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$id_diklat = isset($id_diklat) ? $id_diklat : 0;
?>

<div class="row">
    <div class="col-md-12">

        <form id="frm-daftar-peserta-diklat" partclass="<?php echo $id_diklat; ?>" enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Upload <strong><?php echo $header_title; ?> <?php echo $detail_diklat->nama_diklat; ?> Angkatan <?php echo $detail_diklat->angkatan; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">
                    <div>
                        Upload Excel Sesuai Format.
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Berkas Excel *</label>
                        <div class="col-md-6 col-xs-12">
                            <!--<input type="hidden" name="id_diklat" id="txt-id_diklat" value="<?php echo $detail_diklat ? $detail_diklat->id_diklat : ""; ?>">-->
                            <input type="file" name="berkas_peserta_diklat" id="txt-file_excel" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div class="col-md-6 col-xs-12">                                                                                                                                        
                            <label class="check"><input id="chk-timpa" name="timpa_daftar_peserta_lama" type="checkbox" class="icheckbox" /> Hapus Peserta yang sudah ada</label>
                            <span class="help-block">- Centang untuk menghapus data peserta yang lama (daftar peserta yang lama ditimpa dengan daftar peserta yang baru), <br />- Atau biarkan kosong (tidak dicentang) untuk menambahkan data peserta baru.</span>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Submit</button>
                    <a href="<?php echo base_url("back_end/" . $active_modul . "/index")."/".($detail_diklat ? $detail_diklat->id_diklat_crypted : 0); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>