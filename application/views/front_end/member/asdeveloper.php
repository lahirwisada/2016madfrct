<?php
$developer_eula = isset($developer_eula) ? $developer_eula : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
?>
<div class="push-120"></div>
<div class="line-container line-wrap line-has-sidebar line-sidebar-left">
    <div class="line-page-content">
        <div class="baris-konten line-page-content-inner">
            <div class="entry-header">
                <h3 class="entry-title">
                    <a href="">
                        Menjadi Pengembang Aplikasi
                    </a>
                </h3>
            </div>
            <?php if (!$developer_eula): ?>
                <?php echo load_partial("shared/not_implemented_yet"); ?>
            <?php else: ?>
                <div class="line-wrap line-row push-25 justified-text">
                    <?php echo beautify_text($developer_eula->deskripsi_konten); ?>
                </div>
                <div class="line-wrap">
                    <?php echo load_partial("shared/attention_message"); ?>
                    <div class="line-wrap line-row line-agreement">
                        <?php echo beautify_text($developer_eula->isi_konten); ?>
                    </div>
                    <div class="push-20"></div>
                    <div class="line-wrap">
                        <form method="post" role="form">
                            <input type="hidden" name="anggota_setuju" value="1" />
                            <button type="submit" class="btn btn-default">Saya Setuju dan mematuhi peraturan tersebut</button>
                        </form>
                    </div>
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