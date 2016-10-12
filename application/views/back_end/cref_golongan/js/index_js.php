<script type="text/javascript">
    $(document).ready(function () {
        
        $(".btn-hapus-row").click(function () {
            var url = $(this).attr('rel');

            modalConfirm({
                id: 'message-box-confirm',
                title: 'Mohon Perhatian',
                msg: 'Anda yakin akan menghapus berkas ini?',
                onOk: function () {
                    window.location = url;
                }
            });
        });
    });
</script>