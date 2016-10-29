<?php
$detail = isset($detail) ? $detail : FALSE;
/**
 * this is front_end authentication not back_end
 */
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
?>
<div class="page-content-wrap">
    <div class="page-content-holder">

        <div class="row">
            <div class="col-md-12 this-animate" data-animate="fadeInLeft">

                <div class="text-column">
                    <h4>Konfirmasi Pendaftaran</h4>
                    <?php if (!$detail): ?>
                        <div class="text-column-info">
                            Mohon Maaf Diklat yang anda cari tidak ditemukan.
                        </div>
                    <?php else: ?>
                        <div class="text-column-info">
                            Pastikan data diklat yang anda pilih sudah benar.
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">

                    <?php if ($detail): ?>
                        <div class="col-md-8">
                            <div class="row">
                                Anda akan mendaftarkan diri pada diklat dibawah ini.
                            </div>
                            <div class="row">
                                <div class="fc-row">
                                    <label>Nama Diklat</label> <?php echo $detail->nama_diklat; ?>
                                </div>
                                <div class="fc-row">
                                    <label>Angkatan</label> <?php echo $detail->angkatan; ?>
                                </div>
                                <div class="fc-row">
                                    <label>Nomor SPT</label> <?php echo $detail->no_spt_a . "/" . $detail->no_spt_b . "-" . $detail->no_spt_c . "/" . $detail->no_spt_d; ?> <label>Tanggal</label> <?php echo $detail->tgl_spt; ?>
                                </div>
                                <div class="fc-row">
                                    <label>Penyelenggara</label>
                                </div>
                                <div class="fc-row">
                                    <label>Pelaksanaan</label> <?php echo $detail->tgl_pelaksanaan; ?> - <?php echo $detail->tgl_selesai; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="fc-row">
                                    <label>NIP</label> <?php echo "nip"; ?>
                                </div>
                                <div class="fc-row">
                                    <label>Nama</label> <?php echo "Nama Pegawai"; ?>
                                </div>
                                <div class="fc-row">
                                    <label>Surat Pernyataan</label>
                                    <input type="file" name="fspernyataan" />
                                </div>
                                <div class="fc-row">
                                    Dengan ini saya menyatakan kesediaan untuk mengikuti diklat.
                                    
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="row">
                                Diklat yang anda cari tidak ditemukan.<br />Klik <a href="<?php echo base_url(); ?>">disini</a> untuk kembali.
                            </div>
                        </div>
                    <?php endif; ?>


                </div>

            </div>
        </div>

    </div>
</div>