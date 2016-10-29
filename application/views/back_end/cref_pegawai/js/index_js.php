<script type="text/javascript">
    $(document).ready(function () {
        
        $(".clsHapusPegawai").click(function () {
            var url = $(this).attr('rel');

            modalConfirm({
                id: 'message-box-confirm',
                title: 'Mohon Perhatian',
                msg: 'Maaf aksi yang anda pilih belum diimplementasikan.',
                onOk: function () {
                    return false;
                }
            });
            
            return false;
        });
    });
</script>