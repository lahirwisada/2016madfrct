<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script>
    var slc_bulan_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/msbulan/get_like",
            placeholder: 'Pilih Bulan',
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
                    obj.id = obj.id || obj.id_bulan;
                    obj.text = obj.text || obj.nama_bulan;
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
<?php if ($detail && $detail->id_bulan != ""): ?>
        slc_bulan_cfg.data = [
            {
                id: '<?php echo $detail->id_bulan ?>',
                text: '<?php echo $detail->nama_bulan; ?>'
            }
        ];
<?php endif; ?>
    $(document).ready(function () {
        $("#slc-bulan").select2(slc_bulan_cfg);
<?php if ($detail && $detail->id_bulan != ""): ?>
            $("#slc-bulan").val(<?php echo $detail->id_bulan ?>).trigger("change");
<?php endif; ?>
    });
</script>