<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<div class="page-content-wrap">
    <div class="page-content-holder">

        <div class="row">
            <div class="col-md-12 this-animate" data-animate="fadeInLeft">

                <div class="text-column">
                    <h4>Cek Peserta Diklat</h4>

                    <div class="text-column-info">
                        <?php if (!$detail): ?>
                            Mohon Maaf data Peserta yang anda cari tidak ditemukan.
                        <?php else: ?>
                            
                        <?php endif; ?>
                    </div>

                </div>

                <div class="row">
                    <?php if ($detail): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->nip; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->nama_sambung; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->jabatan; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Golongan</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->golongan; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>SKPD</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->nama_skpd; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Nama Diklat</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->nama_diklat; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Penyelenggara</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->penyelenggara; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Pelaksanaan</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->tgl_pelaksanaan . " - " . $detail->tgl_selesai; ?>"/>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="text-column-info">
                        Untuk memastikan bahwa anda mengakses basis data yang benar, 
                        pastikan bahwa URL (Alamat Situs) pada browser anda adalah <?php echo base_url(); ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>