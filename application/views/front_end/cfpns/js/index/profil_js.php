<script type="text/javascript">

    var frm_profil = {
        data: {
            npwp: null,
        },
        collect_data: function(){
            this.data.npwp = $("#txt-npwp").val();
        },
        init: function(){
            
        },
        save: function(){
            this.collect_data();
            
            if(this.data.npwp.length > 0){
                $.ajax({
                    url: '<?php echo base_url('cfpns/'); ?>'
                });
            }
        }
    };

</script>