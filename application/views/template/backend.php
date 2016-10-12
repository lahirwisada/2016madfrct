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

$target_sub_page = isset($target_sub_page) ? $target_sub_page : FALSE;
$slogan = isset($slogan) ? $slogan : FALSE;

$currentusername = isset($currentusername) ? $currentusername : "Tidak Dikenal";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "Tidak Dikenal";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "Tamu";
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

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
            <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
        <![endif]-->

        <!-- The following CSS are included as plugins and can be removed if unused-->

        <?php echo isset($css) ? $css : ''; ?>
        <?php echo load_partial('template/additional_css'); ?>
        <?php echo $view_css_default; ?>
        <link rel='stylesheet' type='text/css' href='<?php echo css(); ?>avant/plugins/form-toggle/toggles.css' />

    <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
    </head>

    <body class="horizontal-nav ">

        <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
            <ul class="nav navbar-nav pull-right toolbar">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $current_user_profil_name; ?> <i class="fa fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu userinfo arrow">
                        <li class="username">
                            <a href="#">
                                <div>
                                    <h5>Halo, <?php echo $current_user_profil_name; ?>!</h5>
                                    <small>Login sebagai <span><?php echo $currentusername; ?></span></small>
                                    <br />
                                    <small>Peran : </small>
                                    <br />
                                    <small><span><?php echo $current_user_roles; ?></span></small>
                                </div>
                            </a>
                        </li>
                        <li class="userlinks">
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('back_end/member/profil'); ?>">Detil Profil <i class="pull-right fa fa-cog"></i></a></li>
                                <!-- <li><a href="#">Help <i class="pull-right fa fa-question-circle"></i></a></li> -->
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url("back_end/member/logout"); ?>" class="text-right">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <?php echo load_partial('template/backend/menu/template_menu'); ?>

        <div id="page-container">

            <div id="page-content">
                <div id="wrap">
                    <?php echo $content_for_layout; ?>
                </div>
                <!-- #wrap -->
            </div>
            <!-- page-content -->

            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li>lahirwisada@gmail.com &copy; 2014</li>
                    </ul>
                    <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
                </div>
            </footer>

        </div>
        <!-- page-container -->

        <!--
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    
    <script>!window.jQuery && document.write(unescape('%3Cscript src="assets/js/jquery-1.10.2.min.js"%3E%3C/script%3E'))</script>
    <script type="text/javascript">!window.jQuery.ui && document.write(unescape('%3Cscript src="assets/js/jqueryui-1.10.3.min.js'))</script>
        -->
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jqueryui-1.10.3.min.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/enquire.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery.cookie.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/plugins/codeprettifier/prettify.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/plugins/sparklines/jquery.sparklines.min.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/plugins/form-toggle/toggle.js"></script>
        
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery_fancybox.js"></script>
        
        <script type="text/javascript" src="<?php echo assets(); ?>3rd/jquery/jquery.touchSwipe.min.js"></script>
        
        
        <?php echo isset($js) ? $js : ''; ?>
        
        <script type="text/javascript" src="<?php echo assets(); ?>js/helper/general_helper.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/placeholdr.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/avant/application.js"></script>

        
        <?php echo load_partial('template/additional_js'); ?>
        <?php echo $view_js_default; ?>
    </body>
</html>
