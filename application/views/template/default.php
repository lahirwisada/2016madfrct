<?php
$app_author = isset($app_author) ? $app_author : 'Lahir Wisada Santoso';
$global_search_action = isset($global_search_action) ? $global_search_action : "#";
$page_title = isset($page_title) ? $page_title : "Web App";
$app_name = isset($app_name) ? $app_name : "Web App";

$site_description = isset($site_description) ? $site_description : "";
$site_keyword = isset($site_keyword) ? $site_keyword : "";

$view_js_default = isset($js_default) ? $js_default : '';
$view_css_default = isset($css_default) ? $css_default : '';

$template_body_class = isset($template_body_class) ? $template_body_class : '';

$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;

$using_header_background = isset($using_header_background) ? $using_header_background : FALSE;
$target_sub_page = isset($target_sub_page) ? $target_sub_page : FALSE;
$slogan = isset($slogan) ? $slogan : FALSE;

$currentusername = isset($currentusername) ? $currentusername : "pengguna";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "Tidak Dikenal";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "Tamu";
?>


<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="<?php echo strip_tags($site_description); ?>" />
        <meta name="author" content="<?php echo strip_tags($app_author); ?>" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="keywords" content="<?php echo strip_tags($site_keyword); ?>" />
        <title><?php echo strip_tags($page_title); ?></title>
        <link rel="shortcut icon" href="assets/img/favico.ico">
<!--        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>front/gscompiled.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>front/gsstyle.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>front/gsshortcode.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>front/gswoocommerce.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>front/responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>front/gurita_dialog.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo assets(); ?>3rd/font-awesome/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo assets(); ?>3rd/nivo-lightbox/nivo-lightbox.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo assets(); ?>3rd/nivo-lightbox/themes/default/default.css" />

        <!-- Google Font -->
        <link rel="stylesheet" href="<?php echo assets(); ?>font/csse3e5.css?family=Montserrat:400,700" />
        <link rel="stylesheet" href="<?php echo assets(); ?>font/googlefont.css?family=Shadows Into Light:400" />
        <link rel="stylesheet" href="<?php echo assets(); ?>font/css975a.css?family=Raleway:400,700" />

        <?php echo isset($css) ? $css : ''; ?>
        <?php echo load_partial('template/additional_css'); ?>
        <?php echo $view_css_default; ?>
    </head>
    <body class="<?php echo $template_body_class; ?>">
        <div class="line-loader">
            <div class="loader"></div>
        </div>

        <div class="gurita-dialog-overlay"></div>
        <div class="gurita-dialog-box">
            <div class="gurita-dialog-content">
                <div class="gurita-dialog-message"></div>
                <a href="#" class="dialog-button">Close</a>
            </div>
        </div>

        <div>
            <header id="line-header">
                <div class="line-wrap">
                    <div class="line-logo">
                        <a href="<?php echo base_url(); ?>" class="line-logo-simple">
                            <img alt="logo" width="100%" src="<?php echo assets(); ?>img/gurita.png">
                        </a>
                    </div>
                    <div class="line-icon-menu">
                        <span></span>
                    </div>
                    <div class="line-menu">
                        <span></span>
                    </div>
                    <nav class="baris-menu">
                        <?php echo load_partial('template/menu/template_menu'); ?>
                    </nav>
                    <div class="baris-menu-registrasi">
                        <?php if ($is_authenticated): ?>
                            <span class="say-hai">Hai, </span><a href="<?php echo base_url('front_end/member/profil'); ?>"><?php echo $currentusername; ?></a>
                            <a href="<?php echo base_url('front_end/member/logout'); ?>">Keluar</a>
                        <?php else: ?>
                            <a href="<?php echo base_url('front_end/member/login'); ?>">Masuk</a>
                            <a href="<?php echo base_url('front_end/member/register'); ?>">Registrasi</a>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            <div id="baris-halaman-utama">
                <?php
                if ($using_header_background) {
                    echo load_partial('shared/header_background', array('target_sub_page' => $target_sub_page, 'slogan' => $slogan));
                }
                echo $content_for_layout;
                ?>
            </div>

            <?php /*
              <div id = "line-content-bottom">
              <div class = "line-wrap line-sidebar-bottom">

              </div>
              </div>
             */ ?>
            <hr />

            <footer id="line-footer">
                <div class="line-wrap">
                    <div class="copyright">
                        Copyright © 2014 !. All Rights Reserved.
                    </div>
                    <a href="#" id="line-gotop">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </footer>
        </div>



<!--        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-core.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-nav.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-isotope.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-flexslider.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-mb.YTPlayer.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-validate.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-countTo.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-countdown.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-waypoints.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-scrollReveal.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-imagesloaded.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/nivo-lightbox/nivo-lightbox.js"></script>-->
        <?php echo isset($js) ? $js : ''; ?>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-mb.YTPlayer.js"></script>
        <script type="text/javascript" src="<?php echo js(); ?>gscomponents.js"></script>
        <script type="text/javascript" src="<?php echo js(); ?>theme.js"></script>
        <?php echo load_partial('template/additional_js'); ?>
        <?php echo $view_js_default; ?>
    </body>
</html>