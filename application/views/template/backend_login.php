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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $site_description; ?>" />
        <meta name="author" content="<?php echo $app_author; ?>" />

        <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all">  -->
        <link rel="stylesheet" href="<?php echo css(); ?>avant/styles.css?=120" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />

        <link rel='stylesheet' type='text/css' href='<?php echo css(); ?>avant/plugins/form-toggle/toggles.css' />

        <?php echo isset($css) ? $css : ''; ?>
        <?php echo load_partial('template/additional_css'); ?>
        <?php echo $view_css_default; ?>

    </head>
    <body class="focusedform">
        <div class="verticalcenter">
            <?php
            /**
             * Logo disabled
            <a href="index.htm"><img src="<?php echo assets(); ?>img/gurita.jpg" alt="Logo" class="brand" /></a>
             * 
             */
            ?>
            <div class="panel panel-primary">
                <?php echo $content_for_layout; ?>
                <!-- #wrap -->
            </div>
            <!-- page-content -->
        </div>
        <!-- page-container -->

        <?php echo isset($js) ? $js : ''; ?>
        <?php echo load_partial('template/additional_js'); ?>
        <?php echo $view_js_default; ?>
    </body>
</html>
