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
<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/plugins/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/plugins/mixitup/jquery.mixitup.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/plugins/appear/jquery.appear.js"></script>

<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/plugins/revolution-slider/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/plugins/revolution-slider/jquery.themepunch.revolution.min.js"></script>

<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/actions.js"></script>
<script type="text/javascript" src="<?php echo js(); ?>atlant_front_end/slider.js"></script>