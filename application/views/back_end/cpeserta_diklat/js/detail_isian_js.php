<?php

/**
 * used by this module and cref_pegawai
 */
$detail = isset($detail) ? $detail : FALSE;

?>
<script>

    var slc_pegawai_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_pegawai/get_like",
            placeholder: 'Pilih Pegawai',
            dataType: 'json',
            delay: 250,
            method: 'post',
            width: '100%',
            data: function (params) {
                var selected_skpd = $("#slc-skpd").val(), data = {
                    keyword: params.term, // search term
                    id_skpd: false,
                    page: params.page
                };
                if (selected_skpd != null) {
                    data.id_skpd = selected_skpd;
                } else {
                    modalConfirm({
                        id: 'message-box-confirm',
                        title: 'Mohon Perhatian',
                        msg: 'Mohon pilih SKPD terlebih dahulu',
                        onOk: function () {
                        }
                    });
                    return false;
                }
                return data;
            },
            processResults: function (data, params) {

                var data = $.map(data, function (obj) {
                    obj.id = obj.id || obj.id_pegawai;
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
    }, slc_skpd_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_skpd/get_like",
            placeholder: 'Pilih SKPD',
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
                    obj.id = obj.id || obj.id_skpd;
                    obj.text = obj.text || obj.nama_skpd;
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
    }, slc_jabatan_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_jabatan/get_like",
            placeholder: 'Pilih Jabatan',
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
                    obj.id = obj.id || obj.id_jabatan;
                    obj.text = obj.text || obj.jabatan;
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
    }, slc_golongan_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_golongan/get_like",
            placeholder: 'Pilih Golongan',
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
                    obj.text = obj.text || obj.golongan;
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
<?php /** ?>
<?php if ($detail && $detail->id_pegawai != ""): ?>
        slc_pegawai_cfg.data = [
            {
                id: '<?php echo $detail->id_pegawai ?>',
                text: '<?php echo $detail->nama_sambung; ?>'
            }
        ];
<?php endif; ?>
<?php */ ?>
<?php if ($detail && !is_null($detail->id_skpd) && $detail->id_skpd != ""): ?>
        slc_skpd_cfg.data = [
            {
                id: '<?php echo $detail->id_skpd ?>',
                text: '<?php echo $detail->nama_skpd; ?>'
            }
        ];
<?php endif; ?>

<?php if ($detail && !is_null($detail->id_jabatan) && $detail->id_jabatan != ""): ?>
        slc_jabatan_cfg.data = [
            {
                id: '<?php echo $detail->id_jabatan ?>',
                text: '<?php echo $detail->jabatan; ?>'
            }
        ];
<?php endif; ?>

<?php if ($detail && !is_null($detail->id_golongan) && $detail->id_golongan != ""): ?>
        slc_golongan_cfg.data = [
            {
                id: '<?php echo $detail->id_golongan ?>',
                text: '<?php echo $detail->golongan; ?>'
            }
        ];
<?php endif; ?>


    $(document).ready(function () {

<?php /** ?>
        $("#slc-pegawai").select2(slc_pegawai_cfg);
<?php if ($detail && $detail->id_pegawai != ""): ?>
            $("#slc-pegawai").val(<?php echo $detail->id_pegawai ?>).trigger("change");
            ;
<?php endif; ?>
<?php */ ?>
        
        
        $("#slc-skpd").select2(slc_skpd_cfg);
<?php if ($detail && !is_null($detail->id_skpd) && $detail->id_skpd != ""): ?>
            $("#slc-skpd").val(<?php echo $detail->id_skpd; ?>).trigger("change");
<?php endif; ?>
    
        $("#slc-jabatan").select2(slc_jabatan_cfg);
<?php if ($detail && !is_null($detail->id_jabatan) && $detail->id_jabatan != ""): ?>
            $("#slc-jabatan").val(<?php echo $detail->id_jabatan; ?>).trigger("change");
<?php endif; ?>
    
        $("#slc-golongan").select2(slc_golongan_cfg);
<?php if ($detail && !is_null($detail->id_golongan) && $detail->id_golongan != ""): ?>
            $("#slc-golongan").val(<?php echo $detail->id_golongan; ?>).trigger("change");
<?php endif; ?>

    });
</script>