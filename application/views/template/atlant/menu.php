<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;

$active_modul = isset($active_modul) ? $active_modul : "";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "-";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "pengguna";
$menu_item = isset($menu_item) ? build_atlant_menu($menu_item, $active_modul) : "";
?>


<ul class="x-navigation">
    <li class="xn-logo">
        <a href="<?php echo base_url(); ?>">BKPP</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <?php if ($is_authenticated): ?>
            <a href="#" class="profile-mini">
                <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="<?php echo $current_user_profil_name; ?>"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="<?php echo $current_user_profil_name; ?>"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $current_user_profil_name; ?></div>
                    <div class="profile-data-title"><?php echo $current_user_roles; ?></div>
                </div>
                <div class="profile-controls">
                    <?php /*
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                     * 
                     */
                    ?>
                </div>
            </div>
        <?php else: ?>
            <a href="#" class="profile-mini">
                <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="User"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="User"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">User</div>
                    <div class="profile-data-title">Tamu</div>
                </div>
            </div>
        <?php endif ?>                                                                        
    </li>
    <li class="xn-title">Menu</li>
        <?php echo $menu_item; ?>
</ul>