<?php
$role = isset($role) ? $role : 'guest';
$active_menu = isset($active_menu) ? $active_menu : FALSE;
?>
<ul class="line-menu-inner">
    <li class="<?php echo $active_menu && array_key_exists('home', $active_menu)?"current-menu-item":""; ?>">
        <a href="<?php echo base_url(); ?>">Etalase</a>
    </li>
    <li class="<?php echo $active_menu && array_key_exists('about_us', $active_menu)?"current-menu-item":""; ?>">
        <a href="<?php echo base_url(); ?>front_end/about_us/index">Tentang Gurita Store</a>
    </li>
</ul>