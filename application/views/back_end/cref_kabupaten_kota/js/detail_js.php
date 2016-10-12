<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script>

    var slc_provinsi_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_provinsi/get_like",
            placeholder: 'Pilih Provinsi',
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
                    obj.id = obj.id || obj.id_provinsi;
                    obj.text = obj.text || obj.kode_provinsi + " " + obj.nama_provinsi;
                    return obj;
                });
                params.page = params.page || 1;
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

<?php if ($detail && $detail->id_provinsi != ""): ?>
        slc_provinsi_cfg.data = [
            {
                id: '<?php echo $detail->id_provinsi ?>',
                text: '<?php echo $detail->kode_provinsi . " " . $detail->nama_provinsi; ?>'
            }
        ];
<?php endif; ?>
    $(document).ready(function () {
        $("#slc-provinsi").select2(slc_provinsi_cfg);
<?php if ($detail && $detail->id_provinsi != ""): ?>
            $("#slc-provinsi").val(<?php echo $detail->id_provinsi ?>).trigger("change");
            ;
<?php endif; ?>
    });
</script>