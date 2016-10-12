<?php
$app_author = isset($app_author) ? $app_author : 'Lahir Wisada Santoso';
$global_search_action = isset($global_search_action) ? $global_search_action : "#";
$page_title = isset($page_title) ? $page_title : "My Application";
$app_name = isset($app_name) ? $app_name : "My Application";

$site_description = isset($site_description) ? $site_description : "";
$site_keyword = isset($site_keyword) ? $site_keyword : "";

$view_js_default = isset($js_default) ? $js_default : '';
$view_css_default = isset($css_default) ? $css_default : '';

$template_body_class = isset($template_body_class) ? $template_body_class : '';

/**
 * User information
 */
$nama_profil = isset($nama_profil) ? $nama_profil : 'Tidak Dikenal';
$username = isset($username) ? $username : 'tidakdikenal';
$user_role = isset($user_role) ? $user_role : '';
?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $page_title; ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?php echo $site_description; ?>" />
        <meta name="author" content="<?php echo $app_author; ?>" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo css(); ?>atlant/theme-default.css"/>
        
        <?php echo isset($css) ? $css : ''; ?>
        <?php echo load_partial('template/additional_css'); ?>
        <?php echo $view_css_default; ?>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Selamat Datang</strong>, Silahkan melakukan Otentifikasi</div>
                    <?php echo $content_for_layout; ?>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2016 <?php echo $app_name; ?>
                    </div>
                    <?php /**
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                     * 
                     */
                    ?>
                </div>
            </div>
            
        </div>
        
    </body>
</html>






