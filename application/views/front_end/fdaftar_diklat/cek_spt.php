<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<div class="page-content-wrap">
    <div class="page-content-holder">

        <div class="row">
            <div class="col-md-12 this-animate" data-animate="fadeInLeft">

                <div class="text-column">
                    <h4>Cek SPT</h4>
                    <?php if (!$detail): ?>
                        <div class="text-column-info">
                            Mohon Maaf data SPT yang anda cari tidak ditemukan.
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <?php if ($detail): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Diklat</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->nama_diklat; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Angkatan</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->angkatan; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Nomor SPT</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->no_spt_a . "/" . $detail->no_spt_b . "-" . $detail->no_spt_c . "/" . $detail->no_spt_d; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Tanggal SPT</label>
                                <input type="text" style="color: black;" class="form-control" readonly="readonly" value="<?php echo $detail->tgl_spt; ?>"/>
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