<?php
$id_diklat = isset($id_diklat) && $id_diklat ? $id_diklat : ""; 
$detail_diklat = isset($detail_diklat) ? $detail_diklat : FALSE;
?>

<script type="text/javascript">
    
    var formDetailPesertaDiklat = {
        data: {
            nip: null,
            no_kep: null,
            gelar_depan: null,
            nama_depan: null,
            nama_tengah: null,
            nama_belakang: null,
            gelar_belakang: null,
            tempat_lahir: null,
            tgl_lahir: null,
            id_skpd: null,
            id_jabatan: null,
            id_diklat: null,
            
        },
        collectData: function(){
            var self = this;
            
            self.data.id_jabatan = $("#slc-jabatan").val();
            self.data.id_skpd = $("#slc-skpd").val();
            self.data.id_golongan = $("#slc-golongan").val();
            self.data.nip = $("#txt-nip").val();
            self.data.id_diklat = $("#txt-id_diklat").val();
            self.data.no_kep = $("#txt-no_kep").val();
            self.data.gelar_depan = $("#txt-gelar_depan").val();
            self.data.nama_depan = $("#txt-nama_depan").val();
            self.data.nama_tengah = $("#txt-nama_tengah").val();
            self.data.nama_belakang = $("#txt-nama_belakang").val();
            self.data.gelar_belakang = $("#txt-gelar_belakang").val();
            self.data.tempat_lahir = $("#txt-tempat_lahir").val();
            self.data.tgl_lahir = $("#txt-tgl_lahir").val();
            
            return self.data;
        }
    };
    
    $(document).ready(function () {
        
        $("#frm-daftar-peserta-diklat").submit(function(e){
            e.preventDefault();
            
            var data = formDetailPesertaDiklat.collectData();
            
            $.ajax({
                url: "<?php echo base_url('back_end/cpeserta_diklat/detail')."/".$id_diklat; ?>",
                data: data,
                method: 'POST',
                success: function(response, textStatus){
                    window.location.href = "<?php echo base_url("back_end/cpeserta_diklat/index")."/".($detail_diklat ? $detail_diklat->id_diklat_crypted : 0); ?>";
                }
            });
            
            return false;
        });
    });
</script>