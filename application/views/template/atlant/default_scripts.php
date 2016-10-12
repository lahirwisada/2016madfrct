<script type="text/javascript">
    var js_base_url = '<?php echo base_url(); ?>';
    var base_url = function (uri) {
        if (typeof uri !== 'undefined') {
            return js_base_url + "/" + uri;
        }
        return js_base_url;
    };

    var GetImagePath = function ()
    {
        return js_base_url + "_assets/img/";
    }

    var GetCSSPath = function ()
    {
        return js_base_url + "_assets/css/";
    }

</script>
<!-- START PLUGINS -->
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/bootstrap/bootstrap.min.js"></script>        
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='<?php echo js(); ?>atlant/plugins/icheck/icheck.min.js'></script>        
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/morris/morris.min.js"></script>       
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='<?php echo js(); ?>atlant/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='<?php echo js(); ?>atlant/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
<script type='text/javascript' src='<?php echo js(); ?>atlant/plugins/bootstrap/bootstrap-datepicker.js'></script>                
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/owl/owl.carousel.min.js"></script>                 

<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/bootstrap/bootstrap-dialog.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins/bootstrap/bootstrap-select.js"></script>
<!-- END THIS PAGE PLUGINS-->        

<!-- START TEMPLATE -->

<script type="text/javascript" src="<?php echo js(); ?>atlant/plugins.js"></script>        
<script type="text/javascript" src="<?php echo js(); ?>atlant/actions.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant/helper.js"></script>

<!-- <script type="text/javascript" src="<?php echo js(); ?>atlant/demo_dashboard.js"></script> -->
<!-- END TEMPLATE -->