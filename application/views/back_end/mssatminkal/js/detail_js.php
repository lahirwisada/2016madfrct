<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script>
    var slc_kotama_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mskotama/get_like",
            placeholder: 'Pilih Kotama',
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
                    obj.text = obj.text || obj.nama_kotama;
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
    var slc_kesatuan_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mskesatuan/get_like",
            placeholder: 'Pilih Kesatuan',
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
                    obj.id = obj.id || obj.id_kesatuan;
                    obj.text = obj.text || obj.nama_kesatuan;
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
    var slc_corps_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/mscorps/get_like",
            placeholder: 'Pilih Corps',
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
                    obj.id = obj.id || obj.id_corps;
                    obj.text = obj.text || obj.ur_corps;
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
<?php if ($detail && $detail->id_kotama != ""): ?>
        slc_kotama_cfg.data = [
            {
                id: '<?php echo $detail->id_kotama ?>',
                text: '<?php echo $detail->nama_kotama; ?>'
            }
        ];
<?php endif; ?>
<?php if ($detail && $detail->id_kesatuan != ""): ?>
        slc_kesatuan_cfg.data = [
            {
                id: '<?php echo $detail->id_kesatuan ?>',
                text: '<?php echo $detail->nama_kesatuan; ?>'
            }
        ];
<?php endif; ?>
<?php if ($detail && $detail->id_corps != ""): ?>
        slc_corps_cfg.data = [
            {
                id: '<?php echo $detail->id_corps ?>',
                text: '<?php echo $detail->ur_corps; ?>'
            }
        ];
<?php endif; ?>
    $(document).ready(function () {
    });
</script>