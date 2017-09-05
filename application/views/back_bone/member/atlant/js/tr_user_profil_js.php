<?php $detail = isset($detail) ? $detail : FALSE; ?>
<script type="text/javascript">

    var slc_kotama_temp = [];
    var slc_kotama = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mskotama/get_like",
            placeholder: 'Masukkan Nama Kotama',
            dataType: 'json',
            delay: 250,
            method: 'post',
            width: '100%',
            data: function (params) {
                return {
                    keyword: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {

                var data = $.map(data, function (obj) {
                    obj.id = obj.id || obj.id_kotama;
                    obj.text = obj.text || obj.ur_kotama;
                    return obj;
                });
                params.page = params.page || 1;
                slc_kotama_temp = data;

                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 2
    };

<?php if ($detail && $detail->id_kotama != ""): ?>
        slc_kotama.data = [
            {
                id: '<?php echo $detail->id_kotama; ?>',
                text: '<?php echo $detail->ur_kotama; ?>'
            }
        ];
<?php endif; ?>

    $(document).ready(function () {

        $("#slc-kotama").select2(slc_kotama).on("select2:select", function (e) {

            var arrNamaKotama = $.grep(slc_kotama_temp, function (obj) {
                return obj.id == $("#slc-kotama").val();
            });

            if (arrNamaKotama.length > 0) {
                $("input[name=nama_profil]").val(arrNamaKotama[0].nama_kotama);
            }
            slc_kotama_temp = [];
//            $("input[name=nama_profil]").val(data.nama_sambung);
        });

<?php if ($detail && $detail->id_pegawai != ""): ?>
            $("#slc-kotama").val(<?php echo $detail->id_kotama ?>).trigger("change");
<?php endif; ?>

    });
</script>