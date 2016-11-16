<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script>
    var slc_triwulan_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mstriwulan/get_like",
            placeholder: 'Pilih Triwulan',
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
                    obj.id = obj.id || obj.id_triwulan;
                    obj.text = obj.text || obj.nama_triwulan;
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
<?php if ($detail && $detail->id_triwulan != ""): ?>
        slc_triwulan_cfg.data = [
            {
                id: '<?php echo $detail->id_triwulan ?>',
                text: '<?php echo $detail->nama_triwulan; ?>'
            }
        ];
<?php endif; ?>
    $(document).ready(function () {
        $("#slc-triwulan").select2(slc_triwulan_cfg);
<?php if ($detail && $detail->id_triwulan != ""): ?>
            $("#slc-triwulan").val(<?php echo $detail->id_triwulan ?>).trigger("change");
<?php endif; ?>
    });
</script>