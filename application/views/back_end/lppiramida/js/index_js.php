<script type="text/javascript">
    $(document).ready(function () {
        var dalam = new MabesChart("dalam", {
            struktur: "DALAM",
            triwulan: "<?php echo num_to_roman($bulan) ?>",
            tahun: <?php echo $tahun ?>,
            pangkat: <?php echo $records['dalam_pangkat'] ?>,
            tingkat: <?php echo $records['dalam_tingkat'] ?>,
            golongan: <?php echo $records['dalam_golongan'] ?>
        });
        dalam.render();
        var luar = new MabesChart("luar", {
            struktur: "LUAR",
            triwulan: "<?php echo num_to_roman($bulan) ?>",
            tahun: <?php echo $tahun ?>,
            pangkat: <?php echo $records['luar_pangkat'] ?>,
            tingkat: <?php echo $records['luar_tingkat'] ?>,
            golongan: <?php echo $records['luar_golongan'] ?>
        });
        luar.render();
        var gabungan = new MabesChart("gabungan", {
            struktur: "DALAM DAN LUAR",
            triwulan: "<?php echo num_to_roman($bulan) ?>",
            tahun: <?php echo $tahun ?>,
            pangkat: <?php echo $records['gabungan_pangkat'] ?>,
            tingkat: <?php echo $records['gabungan_tingkat'] ?>,
            golongan: <?php echo $records['gabungan_golongan'] ?>
        });
        gabungan.render();
    });
</script>