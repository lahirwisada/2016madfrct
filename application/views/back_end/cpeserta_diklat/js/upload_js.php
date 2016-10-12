<?php
$id_diklat = isset($id_diklat) && $id_diklat ? $id_diklat : "";
$detail_diklat = isset($detail_diklat) ? $detail_diklat : FALSE;
?>
<script type="text/javascript">
    var xls_data_peserta;

    var escape_value = function (obj) {
        if (obj != null) {
            for(var j in obj){
                var clean_index = [0,1,2,3,4,7,8];
                for(var i in clean_index){
                    obj[j][clean_index[i]]["value"] = cleanValue(obj[j][clean_index[i]]["value"]);
                }
            }
            return obj;
        }
        return obj;
    };

    $(document).ready(function () {

//        xls_data_peserta = new lws_excelreader({
//            cells_map: [
//                {col_name: "gelar_depan", x_cell: "B"},
//                {col_name: "nama_depan", x_cell: "C"},
//                {col_name: "nama_tengah", x_cell: "D"},
//                {col_name: "nama_belakang", x_cell: "E"},
//                {col_name: "gelar_belakang", x_cell: "F"},
//                {col_name: "nip", x_cell: "G"},
//                {col_name: "tanggal_lahir", x_cell: "H"},
//                {col_name: "jabatan", x_cell: "I"},
//                {col_name: "tmt_eselon", x_cell: "J"},
//                {col_name: "skpd", x_cell: "K"},
//                {col_name: "gol", x_cell: "L"},
//                {col_name: "masa_kerja_jabatan_tahun", x_cell: "M"},
//                {col_name: "masa_kerja_jabatan_bulan", x_cell: "N"},
//                {col_name: "eselon", x_cell: "O"},
//                {col_name: "pendidikan", x_cell: "P"},
//            ],
//            start_row: 6,
//            _workbook: null,
//            show_in_table: false,
//            inputFileFormName: 'txt-file_excel'
//        });
//
//        $("#frm-daftar-peserta-diklat").submit(function (e) {
//            e.preventDefault();
//
//            var data = {
//                daftar_peserta_diklat: xls_data_peserta.collectData(),
//                override_peserta: ($("#chk-timpa").is(":checked") ? 1 : 0),
//            };
//            
//            data.daftar_peserta_diklat = escape_value(data.daftar_peserta_diklat);
//
//            $.ajax({
//                url: "<?php echo base_url('back_end/cpeserta_diklat/upload') . "/" . $id_diklat; ?>",
//                data: data,
//                contentType: 'multipart/form-data',
//                method: 'POST',
//                success: function (response, textStatus) {
////                    window.location.href = "<?php echo base_url("back_end/cpeserta_diklat/index") . "/" . ($detail_diklat ? $detail_diklat->id_diklat_crypted : 0); ?>";
//                }
//            });
//
//            return false;
//        });
    });
</script>