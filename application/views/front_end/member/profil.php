<?php
$user_detail = isset($user_detail) ? $user_detail : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
$error_found = isset($error_found) ? $error_found : FALSE;
$roles = isset($roles) ? $roles : FALSE;
?>
<div class="push-120"></div>
<div class="line-container line-wrap line-has-sidebar line-sidebar-left">
    <div class="line-page-content">
        <div class="baris-konten line-page-content-inner">
            <?php if ($user_detail): ?>
                <div class="entry-header">
                    <h3 class="entry-title">
                        <a href="">
                            Profil <?php echo is_array($user_detail) ? $user_detail["nama_profil"] : (is_object($user_detail) ? $user_detail->nama_profil : ""); ?>
                        </a>
                    </h3>
                </div>
                <div class="line-wrap">
                    <?php echo load_partial("shared/attention_message"); ?>
                    <div class="line-wrap">
                        <form class="form-horizontal" method="post" role="form">
                            <div class="form-group">
                                <label for="inp-username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <?php echo $user_detail['username']; ?>
                                    <?php if ($roles): ?>
                                        <br />
                                        <small>(<?php echo $roles; ?>)</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="old-password" class="col-sm-2 control-label">Password (Lama) *</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="old-password" placeholder="Password (Lama)" name="oldpassword" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new-password" class="col-sm-2 control-label">Password (Baru)</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="new-password" placeholder="Password (Baru)" name="newpassword" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inp-email" class="col-sm-2 control-label">Email *</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inp-email" placeholder="Email" name="email_profil" value="<?php echo $user_detail['email_profil']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inp-nama" class="col-sm-2 control-label">Nama *</label>
                                <div class="col-sm-10">
                                    <input type="nama" class="form-control" id="inp-nama" placeholder="Nama" name="nama_profil" value="<?php echo $user_detail['nama_profil']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="line-wrap">
                    Pengguna tidak ditemukan.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!--end line-page-content-->
    <div class="line-page-sidebar">
        <?php echo load_partial("front_end/member/shared/_member_left_side_menu"); ?>
    </div>
    <!--end line-page-sidebar-->
</div>