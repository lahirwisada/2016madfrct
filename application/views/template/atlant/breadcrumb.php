<?php
$bread_crumb = isset($bread_crumb) ? $bread_crumb : FALSE;
?>
<ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Home</a></li>
    <?php if ($bread_crumb): ?>
        <?php foreach ($bread_crumb as $bread_crumb_uri_string => $bread_crumb_label): ?>
            <?php if ($bread_crumb_uri_string == "#"): ?>
                <li class="active"><?php echo $bread_crumb_label; ?></li>
                <?php else: ?>
                <li><a href="<?php echo base_url($bread_crumb_uri_string); ?>"><?php echo $bread_crumb_label; ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</ul>