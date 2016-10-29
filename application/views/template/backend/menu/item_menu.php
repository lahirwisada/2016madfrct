<?php
$menu_item = isset($menu_item) ? build_backend_menu($menu_item) : "";
?>

<ul class="nav navbar-nav">
    <li id="li-masters" class="dropdown">
        <a href="<?php echo base_url() ?>"><span>Front End</span></a>
    </li>
    <?php echo $menu_item; ?>
</ul>