<?php
$detail = isset($detail) ? $detail : FALSE;
$gambar_petak = isset($gambar_petak) ? $gambar_petak : FALSE;
$fasilitas_petak = isset($fasilitas_petak) ? $fasilitas_petak : FALSE;
$harga_petak = isset($harga_petak) ? $harga_petak : FALSE;
?>

<section id="content">
    <div class="container">
        <div id="main">
            <div class="page">
                <div class="post-content">
                    <div class="blog-infinite">
                        <div class="post">
                            <div class="post-content-wrapper">
                                <div class="details">
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('front_end/home'); ?>">kembali</a>
                                    </div>
                                    <?php if ($detail): ?>
                                        <div class="details">
                                            <h1 class="box-title"><?php echo beautify_str($detail->nama_petak); ?></h1>
                                        </div>
                                        <br />
                                        <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                                            <?php if($gambar_petak): ?>
                                            <ul class="slides">
                                                <?php foreach($gambar_petak as $record): ?>
                                                <li><img src="<?php echo upload_location('petak/'.$record->nama_file); ?>" alt="" /></li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?php endif; ?>
                                        </div>
                                        <br />
                                        <div class="intro table-wrapper full-width hidden-table-sms">
                                            <div class="col-sm-5 col-lg-4 features table-cell">
                                                <h4>Profil</h4>
                                                <ul>
                                                    <li><label>Harga:</label><?php echo $harga_petak && $harga_petak != "" ? rupiah_display($harga_petak) : "N/A"; ?></li>
                                                    <li><label>Luas m2:</label><?php echo beautify_str($detail->luas); ?></li>
                                                    <li><label>Kapasitas:</label><?php echo beautify_str($detail->kapasitas); ?></li>
                                                    <li><label>Tempat Parkir:</label><?php echo beautify_str(convert_bool_to_word($detail->ada_parkir)); ?></li>
                                                    <li><label>ada Pagar Pengaman:</label><?php echo beautify_str(convert_bool_to_word($detail->ada_pagar)); ?></li>
                                                    <li><label>Kamar Mandi dalam:</label><?php echo beautify_str(convert_bool_to_word($detail->ada_kamar_mandi)); ?></li>
                                                </ul>
                                            </div>
                                            <?php if ($fasilitas_petak && $fasilitas_petak->record_set): ?>
                                                <div class="col-sm-7 col-lg-8 table-cell testimonials">
                                                    <h4>Fasilitas</h4>
                                                    <ul>
                                                        <?php foreach ($fasilitas_petak->record_set as $key => $fasilitas): ?>
                                                            <li><label>- </label><?php echo $fasilitas->nama_fasilitas; ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <br />
                                        <div class="long-description">
                                            <h2>Tentang <?php echo beautify_str($detail->nama_petak); ?></h2>
                                            <?php echo $detail->deskripsi; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="excerpt-container">
                                            <p>Data tidak ditemukan.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>