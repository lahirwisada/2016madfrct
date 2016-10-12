<script type="text/javascript">
    $(document).ready(function(){
        $("#captcha_refresh").click(function(){
            $.ajax({
                url: '<?php echo base_url('front_end/member/refresh_captcha'); ?>',
                success: function(data){
                    if(data.img_url){
                        $("#lcaptcha_image_random").attr("src", data.img_url);
                    }
                }
            });
        });
    });
</script>