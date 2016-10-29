<?php
$register_success = isset($register_success) ? $register_success : FALSE;
$model_user_attributes = isset($model_user_attributes) && array_have_value($model_user_attributes) ? $model_user_attributes : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
$captcha_image = isset($captcha_image) ? $captcha_image : FALSE;
?>
<div class="line-container">
    <div class="line-page-content">
        <div class="line-section line-page-content-inner">
            <div class="line-wrap line-row">
                <h2>Pendaftaran</h2>
            </div>
            <?php if ($captcha_image): ?>
                <?php if (!$register_success): ?>
                    <div class="line-wrap">
                        <div class="line-wrap">
                            Silahkan isi formulir dibawah ini untuk membuat Akun Gurita Store.
                            <br />
                            Bila anda sudah memiliki Akun Gurita Store silahkan <a href="<?php echo base_url('front_end/member/login'); ?>">masuk</a>.
                        </div>
                        <hr />
                        <?php echo load_partial("shared/attention_message"); ?>
                        <div class="line-wrap">
                            <form class="form-horizontal" method="post" role="form">
                                <div class="form-group">
                                    <label for="inp-username" class="col-sm-2 control-label">Username *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inp-username" placeholder="Username" name="username" value="<?php echo $model_user_attributes ? $model_user_attributes['username'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inp-password" class="col-sm-2 control-label">Password *</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inp-password" placeholder="Password" name="password" value="<?php echo $model_user_attributes ? $model_user_attributes['password'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inp-email" class="col-sm-2 control-label">Email *</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inp-email" placeholder="Email" name="email_profil" value="<?php echo $model_user_attributes ? $model_user_attributes['email_profil'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inp-nama" class="col-sm-2 control-label">Nama *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inp-nama" placeholder="Nama" name="nama_profil" value="<?php echo $model_user_attributes ? $model_user_attributes['nama_profil'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inp-nama" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <?php echo $captcha_image; ?><a href="javascript:void(0)" id="captcha_refresh">perbarui</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inp-nama" class="col-sm-2 control-label">Tuliskan dengan angka dari kalimat yang terdapat pada gambar *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inp-captcha" placeholder="" name="input_captcha" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="line-wrap">
                        Pendaftaran Akun Gurita Store berhasil dilakukan.
                        <br />
                        Silahkan <a href="<?php echo base_url('front_end/member/login'); ?>">masuk</a>.
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="line-wrap">
                    Mohon maaf, pendaftaran ditutup untuk sementara dengan alasan kurangnya sekuritas.
                    <br />
                    Jika anda telah memiliki akun silahkan <a href="<?php echo base_url('front_end/member/login'); ?>">masuk</a>.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>