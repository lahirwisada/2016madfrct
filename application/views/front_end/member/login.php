<?php
$login_success = isset($login_success) ? $login_success : FALSE;
$model_user_attributes = isset($model_user_attributes) && array_have_value($model_user_attributes) ? $model_user_attributes : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
?>
<div class="line-container">
    <div class="line-page-content">
        <div class="line-section line-page-content-inner">
            <div class="line-wrap line-row">
                <h2>Otentifikasi</h2>
            </div>
            <?php if (!$login_success): ?>
                <div class="line-wrap">
                    <div class="line-wrap">
                        Silahkan masuk dengan Akun Gurita Store Anda.
                        <br />
                        Bila anda belum memiliki Akun Gurita Store silahkan melakukan <a href="<?php echo base_url('front_end/member/register'); ?>">Pendaftaran</a>.
                    </div>
                    <hr />
                    <?php if ($attention_messages): ?>
                        <div class="line-wrap">
                            <h4>Periksa kembali isian anda.</h4>
                            <?php echo $attention_messages; ?>
                        </div>
                        <hr />
                    <?php endif; ?>
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
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="line-wrap">
                    Otentifikasi berhasil dilakukan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>