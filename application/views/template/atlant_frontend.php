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

$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;

/**
 * User information
 */
$target_sub_page = isset($target_sub_page) ? $target_sub_page : FALSE;
$slogan = isset($slogan) ? $slogan : FALSE;

$currentusername = isset($currentusername) ? $currentusername : "Tidak Dikenal";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "Tidak Dikenal";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "Tamu";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title><?php echo $page_title; ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?php echo $site_description; ?>" />
        <meta name="author" content="<?php echo $app_author; ?>" />

        <link rel="icon" href="<?php echo img(); ?>atlant/favicon.ico" type="image/x-icon" />

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo img(); ?>atlant/ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo img(); ?>atlant/ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo img(); ?>atlant/ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo img(); ?>atlant/ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo img(); ?>atlant/ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo img(); ?>atlant/ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo img(); ?>atlant/ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo img(); ?>atlant/ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo img(); ?>atlant/ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo img(); ?>atlant/ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo img(); ?>atlant/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo img(); ?>atlant/ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo img(); ?>atlant/ico/favicon-16x16.png">
        <link rel="manifest" href="<?php echo img(); ?>atlant/ico/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo img(); ?>atlant/ico/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- END META SECTION -->

        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>atlant_front_end/revolution-slider/extralayers.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>atlant_front_end/revolution-slider/settings.css" media="screen" />

        <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>atlant_front_end/styles.css" media="screen" />                  
        <?php echo isset($css) ? $css : ''; ?>
    </head>
    <body>
        <!-- page container -->
        <div class="page-container">

            <!-- page header -->
            <div class="page-header">

                <!-- page header holder -->
                <div class="page-header-holder">

                    <!-- page logo -->
                    <div class="logo">
                        <a href="#" onclick="javascript:void();">BKPP</a>
                    </div>
                    <!-- ./page logo -->


                    <!-- search -->
                    <div class="search">
                        <div class="search-button"><span class="fa fa-search"></span></div>
                        <div class="search-container animated fadeInDown">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..."/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><span class="fa fa-search"></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- ./search -->

                    <!-- nav mobile bars -->
                    <div class="navigation-toggle">
                        <div class="navigation-toggle-button"><span class="fa fa-bars"></span></div>
                    </div>
                    <!-- ./nav mobile bars -->

                    <!-- navigation -->
                    <?php echo load_partial('template/atlant_frontend/menu'); ?>  
                    <!-- ./navigation -->                        


                </div>
                <!-- ./page header holder -->

            </div>
            <!-- ./page header -->

            <!-- page content -->
            <div class="page-content">

                <!-- page content wrapper -->
                <?php echo load_partial('template/atlant_frontend/breadcrumb'); ?>  

                <?php echo $content_for_layout; ?>
            </div>
            <!-- ./page content -->

            <!-- page footer -->
            <div class="page-footer">

                <!-- page footer wrap -->
                <div class="page-footer-wrap bg-dark-gray">
                    <!-- page footer holder -->
                    <div class="page-footer-holder page-footer-holder-main">

                        <?php echo load_partial('template/atlant_frontend/footer'); ?>

                    </div>
                    <!-- ./page footer holder -->
                </div>
                <!-- ./page footer wrap -->

                <!-- page footer wrap -->
                <div class="page-footer-wrap bg-darken-gray">
                    <!-- page footer holder -->
                    <div class="page-footer-holder">

                        <!-- copyright -->
                        <div class="copyright">
                            &copy; 2016 <a href="#">BKPP</a> Kota Tangerang Selatan
                        </div>
                        <!-- ./copyright -->

                        <!-- social links -->
                        <div class="social-links">
                            <a href="https://www.facebook.com/bkpptangsel"><span class="fa fa-facebook"></span></a>
                            <a href="https://twitter.com/bkpptangsel"><span class="fa fa-twitter"></span></a>
                                <?php /* <a href="#"><span class="fa fa-google-plus"></span></a>
                                  <a href="#"><span class="fa fa-linkedin"></span></a>
                                  <a href="#"><span class="fa fa-vimeo-square"></span></a>
                                  <a href="#"><span class="fa fa-dribbble"></span></a>
                                 * 
                                 */
                                ?>
                        </div>                        
                        <!-- ./social links -->

                    </div>
                    <!-- ./page footer holder -->
                </div>
                <!-- ./page footer wrap -->

            </div>
            <!-- ./page footer -->

        </div>        
        <!-- ./page container -->

        <!-- page scripts -->
        <?php echo load_partial('template/atlant_frontend/default_scripts'); ?>

        <?php echo isset($js) ? $js : ''; ?>
        <script type="text/javascript" src="<?php echo assets(); ?>js/helper/general_helper.js"></script>
        <?php echo load_partial('template/additional_js'); ?>

        <?php echo $view_js_default; ?>
        <!-- ./page scripts -->
    </body>
</html>