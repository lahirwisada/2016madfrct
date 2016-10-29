<?php
$heading = isset($heading) ? $heading : "ERROR";
$message = isset($message) ? $message : "Tidak diketahui";
$status_code = isset($status_code) ? $status_code : "400";
?>
<div class="line-container">
    <div class="line-page-content">
            <div class="line-section line-page-content-inner">
                <div class="line-wrap line-row">
                    <div class="line-wrap line-row">
                        <h2><?php echo $heading; ?></h2>
                    </div>
                    <hr class="hr-margin-5px">
                </div>
                <div class="line-wrap line-row">
                    <?php echo $message; ?>
                </div>
            </div>
        <div class="line-wrap line-row push-25">
            <div class="three-fourth">&nbsp;</div>
            <div class="one-fourth last"><a onclick="goBack();" class="line-btn">Kembali</a></div>
        </div>
    </div>
</div>