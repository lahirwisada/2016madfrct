<script type="text/javascript">
    $(document).ready(function () {

        $(".btn-detil-row").click(function () {
            var url = $(this).attr('rel');

            modalConfirm({
                id: 'message-box-confirm',
                title: 'Mohon Perhatian',
                msg: 'Anda akan diarahkan ke halaman detil pegawai. Apakah anda ingin melanjutkan ?',
                onOk: function () {
                    window.location = url;
                }
            });

            return false;
        });

        $(".btn-sttpp-row").click(function () {
            window.location = $(this).attr('rel');
            return false;
        });
    });
</script>