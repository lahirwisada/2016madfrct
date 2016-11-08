<?php
$user_detail = isset($user_detail) ? $user_detail : FALSE;
$sess_detail = isset($sess_detail) ? $sess_detail : FALSE;
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
?>
<div class="page-content-wrap">
    <div class="page-content-holder">
        <div class="col-md-12">
            <?php if ($is_authenticated): ?>
                <div class="row">

                    <div class="text-column">
                        <h4>Profil <?php echo $user_detail ? beautify_str($user_detail->nama_sambung) : "PNS"; ?></h4>
                    </div>
                    <div class="row">
                        <div class="text-column-info">
                            <?php if ($user_detail): ?>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" readonly="readonly" class="form-control" value="<?php echo $user_detail->nip; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" readonly="readonly" class="form-control" value="<?php echo beautify_str($user_detail->nama_sambung); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>SKPD</label>
                                        <input type="text" readonly="readonly" class="form-control" value="<?php echo beautify_str($user_detail->nama_skpd); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>NPWP <span class="text-hightlight">*</span></label>
                                        <input id="txt-npwp" type="text" name="npwp" class="form-control" value="<?php echo beautify_str($user_detail->npwp); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" readonly="readonly" class="form-control" value="<?php echo $sess_detail["username"]; ?>"/>
                                    </div>
                                    <button id="btn-simpan-data-profil" class="btn btn-primary btn-lg pull-right">Simpan</button>
                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                            <?php else: ?>
                                Data tidak ditemukan.
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-12 this-animate" data-animate="fadeInLeft">

                        <div class="text-column">
                            <h4>Profil PNS</h4>
                        </div>
                        <div class="row">
                            <div class="text-column-info">
                                Halo, Halaman ini hanya tersedia untuk Pegawai Negeri Sipil di lingkungan Kota Tangerang Selatan.<br />
                                Lakukan Otentifikasi terlebih dahulu untuk dapat mengakses halaman ini.
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
