<script type="text/javascript">
    $(document).ready(function () {
        var dalam = new MabesChart("dalam", {
            struktur: "DALAM",
            triwulan: "<?php echo num_to_roman($bulan) ?>",
            tahun: <?php echo $tahun ?>,
            pangkat: <?php echo $records['dalam_pangkat'] ?>,
            tingkat: <?php echo $records['dalam_tingkat'] ?>,
            golongan: <?php echo $records['dalam_golongan'] ?>,
            max: <?php echo $records['max_dalam'] ?>
        });
        dalam.render();
        var luar = new MabesChart("luar", {
            struktur: "LUAR",
            triwulan: "<?php echo num_to_roman($bulan) ?>",
            tahun: <?php echo $tahun ?>,
            pangkat: <?php echo $records['luar_pangkat'] ?>,
            tingkat: <?php echo $records['luar_tingkat'] ?>,
            golongan: <?php echo $records['luar_golongan'] ?>,
            max: <?php echo $records['max_luar'] ?>
        });
        luar.render();
        var gabungan = new MabesChart("gabungan", {
            struktur: "DALAM & LUAR",
            triwulan: "<?php echo num_to_roman($bulan) ?>",
            tahun: <?php echo $tahun ?>,
            pangkat: <?php echo $records['gabungan_pangkat'] ?>,
            tingkat: <?php echo $records['gabungan_tingkat'] ?>,
            golongan: <?php echo $records['gabungan_golongan'] ?>,
            max: <?php echo $records['max_gabungan'] ?>
        });
        gabungan.render();
    });
</script>