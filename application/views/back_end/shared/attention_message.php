<?php
$error_found = isset($error_found) ? $error_found : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
?>
<?php if ($attention_messages): ?>
    <div class="alert alert-dismissable alert-warning">
        <?php echo $attention_messages; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
<?php endif; ?>