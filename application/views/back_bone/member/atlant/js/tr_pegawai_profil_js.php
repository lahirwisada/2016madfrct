<?php $detail = isset($detail) ? $detail : FALSE; ?>
<script type="text/javascript">

    var slc_pegawai_temp = [];
    var slc_pegawai = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>back_end/cref_pegawai/get_like",
            placeholder: 'Masukkan NIP',
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
                    obj.id = obj.id || obj.id_pegawai;
                    obj.text = obj.text || obj.nip + " " + obj.nama_sambung;
                    return obj;
                });
                params.page = params.page || 1;
                slc_pegawai_temp = data;

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

<?php if ($detail && $detail->id_pegawai != ""): ?>
        slc_pegawai.data = [
            {
                id: '<?php echo $detail->id_pegawai; ?>',
                text: '<?php echo $detail->nip . " " . $detail->nama_sambung; ?>'
            }
        ];
<?php endif; ?>

    $(document).ready(function () {

        $("#slc-nip").select2(slc_pegawai).on("select2:select", function (e) {
            
            var arrNamaPeg = $.grep(slc_pegawai_temp, function (obj) {return obj.id == $("#slc-nip").val();});
            
            if(arrNamaPeg.length > 0){
                $("input[name=nama_profil]").val(arrNamaPeg[0].nama_sambung);
            }
            slc_pegawai_temp = [];
//            $("input[name=nama_profil]").val(data.nama_sambung);
        });

<?php if ($detail && $detail->id_pegawai != ""): ?>
            $("#slc-nip").val(<?php echo $detail->id_pegawai ?>).trigger("change");
<?php endif; ?>

    });
</script>