<?php
$severity = isset($severity) ? $severity : "";
$message = isset($message) ? $message : "";
$filename = isset($filename) ? $filename : "";
$line_number = isset($line_number) ? $line_number : "";
?>
<div class="line-container">
    <div class="line-page-content">
        <div class="line-section line-page-content-inner">
            <div class="line-wrap line-row">
                <div class="line-wrap line-row">
                    <h2>Sistem Error</h2>
                </div>
                <hr class="hr-margin-5px">
            </div>
            <div class="line-wrap line-row">
                Severity : <?php echo $severity; ?>.
                <br />
                Pesan : <?php echo $message; ?>.
                <br />
                Nama File : <?php echo $filename; ?>.
                <br />
                Nomor Baris : <?php echo $line_number; ?>.
            </div>
        </div>
        <div class="line-wrap line-row push-25">
            <div class="three-fourth">&nbsp;</div>
            <div class="one-fourth last"><a onclick="goBack();" class="line-btn">Kembali</a></div>
        </div>
    </div>
</div>