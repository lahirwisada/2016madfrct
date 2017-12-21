<Row ss:Index="<?php echo $start; ?>" ss:AutoFitHeight="0">
    <Cell ss:StyleID="m00007"><Data ss:Type="String">KESATUAN : <?php echo strtoupper($ur_satminkal) ?></Data></Cell>
</Row>
<Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">NO</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">PANGKAT</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">TOP</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="m00001"><Data ss:Type="String">NYATA</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">STATUS</Data></Cell>
    <?php if ($babinsa == 1): ?>
        <Cell ss:MergeAcross="1" ss:StyleID="m00001"><Data ss:Type="String">DANRAMIL</Data></Cell>
        <Cell ss:MergeAcross="1" ss:StyleID="m00001"><Data ss:Type="String">BABINSA</Data></Cell>
    <?php endif; ?>
</Row>
<Row ss:AutoFitHeight="0">
    <Cell ss:Index="4" ss:MergeDown="1" ss:StyleID="m00002"><Data ss:Type="String">DINAS AKTIF</Data></Cell>
    <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">MPP</Data></Cell>
    <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">LF</Data></Cell>
    <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">SKORSING</Data></Cell>
    <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">JUMLAH</Data></Cell>
    <?php if ($babinsa == 1): ?>
        <Cell ss:Index="10" ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">TOP</Data></Cell>
        <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">NYATA</Data></Cell>
        <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">TOP</Data></Cell>
        <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">NYATA</Data></Cell>
    <?php endif; ?>
</Row>
<Row ss:AutoFitHeight="0"/>
<Row ss:AutoFitHeight="0">
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <Cell ss:StyleID="m00006"/>
    <?php if ($babinsa == 1): ?>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
    <?php endif; ?>
</Row>
<?php if ($pangkat): ?>
    <?php $nomor = 1; ?>
    <?php foreach ($pangkat as $row) : ?>
        <Row ss:AutoFitHeight="0">
            <Cell ss:StyleID="m00006"><Data ss:Type="Number"><?php echo $nomor++ ?></Data></Cell>
            <Cell ss:StyleID="m00006"><Data ss:Type="String"><?php echo strtoupper($row['ur_pangkat']) ?></Data></Cell>
            <Cell ss:StyleID="m00005"/>
            <Cell ss:StyleID="m00005"/>
            <Cell ss:StyleID="m00005"/>
            <Cell ss:StyleID="m00005"/>
            <Cell ss:StyleID="m00005"/>
            <Cell ss:StyleID="m00005" ss:Formula="=SUM(RC[-4]:RC[-1])"><Data ss:Type="Number">0</Data></Cell>
            <Cell ss:StyleID="m00005" ss:Formula="=(RC[-6]-RC[-1])"><Data ss:Type="Number">0</Data></Cell>
            <?php if ($babinsa == 1): ?>
                <Cell ss:StyleID="m00005"/>
                <Cell ss:StyleID="m00005"/>
                <Cell ss:StyleID="m00005"/>
                <Cell ss:StyleID="m00005"/>
            <?php endif; ?>
        </Row>
    <?php endforeach; ?>
    <Row ss:AutoFitHeight="0">
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <Cell ss:StyleID="m00006"/>
        <?php if ($babinsa == 1): ?>
            <Cell ss:StyleID="m00006"/>
            <Cell ss:StyleID="m00006"/>
            <Cell ss:StyleID="m00006"/>
            <Cell ss:StyleID="m00006"/>
        <?php endif; ?>
    </Row>
<?php endif; ?>
<Row ss:AutoFitHeight="0">
    <Cell ss:MergeAcross="1" ss:StyleID="m00001"><Data ss:Type="String">JUMLAH</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <?php if ($babinsa == 1): ?>
        <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
        <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
        <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
        <Cell ss:StyleID="m00005" ss:Formula="=SUM(R[-39]C:R[-1]C)"><Data ss:Type="Number">0</Data></Cell>
    <?php endif; ?>
</Row>
