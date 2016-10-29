<?php 
$error_found = isset($error_found) ? $error_found : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
?>
<?php if ($attention_messages): ?>
    <div class="line-wrap">
        <?php if ($error_found): ?>
            <h4>Periksa kembali isian anda.</h4>
        <?php endif; ?>
        <?php echo $attention_messages; ?>
    </div>
    <hr />
<?php endif; ?>