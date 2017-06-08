<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script>
    var slc_kelompok_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mskelompokpangkat/get_like",
            placeholder: 'Pilih Kelompok',
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
                    obj.id = obj.id || obj.id_kelompok;
                    obj.text = obj.text || obj.ur_kelompok;
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
    var slc_golongan_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/msgolonganpangkat/get_like",
            placeholder: 'Pilih Kelompok',
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
                    obj.id = obj.id || obj.id_golongan;
                    obj.text = obj.text || obj.ur_golongan;
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
    var slc_tingkat_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mstingkatpangkat/get_like",
            placeholder: 'Pilih Kelompok',
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
                    obj.id = obj.id || obj.id_tingkat;
                    obj.text = obj.text || obj.ur_tingkat;
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

<?php if ($detail && $detail->id_kelompok != ""): ?>
        slc_kelompok_cfg.data = [
            {
                id: '<?php echo $detail->id_kelompok ?>',
                text: '<?php echo $detail->ur_kelompok; ?>'
            }
        ];
<?php endif; ?>
<?php if ($detail && $detail->id_golongan != ""): ?>
        slc_golongan_cfg.data = [
            {
                id: '<?php echo $detail->id_golongan ?>',
                text: '<?php echo $detail->ur_golongan; ?>'
            }
        ];
<?php endif; ?>
<?php if ($detail && $detail->id_tingkat != ""): ?>
        slc_tingkat_cfg.data = [
            {
                id: '<?php echo $detail->id_tingkat ?>',
                text: '<?php echo $detail->ur_tingkat; ?>'
            }
        ];
<?php endif; ?>

    $(document).ready(function () {
        $("#slc-kelompok").select2(slc_kelompok_cfg);
<?php if ($detail && $detail->id_kelompok != ""): ?>
            $("#slc-kelompok").val(<?php echo $detail->id_kelompok ?>).trigger("change");
            ;
<?php endif; ?>
        $("#slc-golongan").select2(slc_golongan_cfg);
<?php if ($detail && $detail->id_golongan != ""): ?>
            $("#slc-golongan").val(<?php echo $detail->id_golongan ?>).trigger("change");
            ;
<?php endif; ?>
        $("#slc-tingkat").select2(slc_tingkat_cfg);
<?php if ($detail && $detail->id_tingkat != ""): ?>
            $("#slc-tingkat").val(<?php echo $detail->id_tingkat ?>).trigger("change");
            ;
<?php endif; ?>
    });
</script>