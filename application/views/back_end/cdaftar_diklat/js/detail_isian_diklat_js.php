<?php
$detail = isset($detail) ? $detail : FALSE;
?>

<script type="text/javascript">

    var slc_kab_kota_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_kabupaten_kota/get_like",
            placeholder: 'Pilih Kota',
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
                    obj.id = obj.id || obj.id_kabupaten_kota;
                    obj.text = obj.text || obj.kode_kabupaten + " " + obj.nama_kabupaten;
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
    }, slc_ttd_spt_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_ttd/get_like",
            placeholder: 'Pilih Penandatangan',
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
                    obj.id = obj.id || obj.id_ref_ttd;
                    obj.text = obj.text || obj.nama_sambung;
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
    }, slc_ttd_sttpp_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_ttd/get_like",
            placeholder: 'Pilih Penandatangan',
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
                    obj.id = obj.id || obj.id_ref_ttd;
                    obj.text = obj.text || obj.nama_sambung;
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

<?php if ($detail && $detail->id_ref_ttd_sttpp != ""): ?>
        slc_ttd_sttpp_cfg.data = [
            {
                id: '<?php echo $detail->id_ref_ttd_sttpp; ?>',
                text: '<?php echo $detail->nama_sambung_sttpp; ?>'
            }
        ];
<?php endif; ?>

<?php if ($detail && $detail->id_ref_ttd != ""): ?>
        slc_ttd_spt_cfg.data = [
            {
                id: '<?php echo $detail->id_ref_ttd ?>',
                text: '<?php echo $detail->nama_sambung; ?>'
            }
        ];
<?php endif; ?>

<?php if ($detail && $detail->id_kabupaten_kota != ""): ?>
        slc_kab_kota_cfg.data = [
            {
                id: '<?php echo $detail->id_kabupaten_kota ?>',
                text: '<?php echo $detail->kode_kabupaten . " " . $detail->nama_kabupaten; ?>'
            }
        ];
<?php endif; ?>


    $(document).ready(function () {
        
        $("#slc-kab-kota").select2(slc_kab_kota_cfg);
        $("#slc-ttd").select2(slc_ttd_spt_cfg);
        $("#slc-ttd_sttpp").select2(slc_ttd_sttpp_cfg);
        
<?php if ($detail && $detail->id_kabupaten_kota != ""): ?>
            $("#slc-kab-kota").val(<?php echo $detail->id_kabupaten_kota ?>).trigger("change");
<?php endif; ?>
        
<?php if ($detail && $detail->id_ref_ttd != ""): ?>
            $("#slc-ttd").val(<?php echo $detail->id_ref_ttd ?>).trigger("change");
<?php endif; ?>
        
<?php if ($detail && $detail->id_ref_ttd_sttpp != ""): ?>
            $("#slc-ttd_sttpp").val(<?php echo $detail->id_ref_ttd_sttpp; ?>).trigger("change");
<?php endif; ?>
    
    });
</script>