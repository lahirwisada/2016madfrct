<?php echo "<?xml version=\"1.0\" ?>"; ?>
<?php echo "<?mso-application progid=\"Excel.Sheet\" ?>"; ?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
          xmlns:o="urn:schemas-microsoft-com:office:office"
          xmlns:x="urn:schemas-microsoft-com:office:excel"
          xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
          xmlns:html="http://www.w3.org/TR/REC-html40">
    <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
        <Title>Laporan Personel</Title>
        <Author>Rinaldi</Author>
        <LastAuthor>Rinaldi</LastAuthor>
        <Created>2017-10-24T14:44:58Z</Created>
        <LastSaved>2017-12-05T13:42:47Z</LastSaved>
        <Company>Microsoft Corporation</Company>
        <Version>14.00</Version>
    </DocumentProperties>
    <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
        <AllowPNG/>
    </OfficeDocumentSettings>
    <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
        <WindowHeight>7905</WindowHeight>
        <WindowWidth>20490</WindowWidth>
        <WindowTopX>0</WindowTopX>
        <WindowTopY>0</WindowTopY>
        <ProtectStructure>False</ProtectStructure>
        <ProtectWindows>False</ProtectWindows>
    </ExcelWorkbook>
    <Styles>
        <Style ss:ID="Default" ss:Name="Normal">
            <Alignment ss:Vertical="Bottom"/>
            <Borders/>
            <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
            <Interior/>
            <NumberFormat/>
            <Protection/>
        </Style>
        <Style ss:ID="m00001">
            <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
            <Borders>
            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            </Borders>
        </Style>
        <Style ss:ID="m00002">
            <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
            <Borders>
            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            </Borders>
        </Style>
        <Style ss:ID="m00003">
            <Alignment ss:Horizontal="Right" ss:Vertical="Center"/>
            <Borders>
            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            </Borders>
        </Style>
        <Style ss:ID="m00004">
            <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
            <Borders>
            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            </Borders>
        </Style>
        <Style ss:ID="m00005">
            <Alignment ss:Horizontal="Right" ss:Vertical="Center"/>
            <Borders>
            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            </Borders>
            <NumberFormat ss:Format="#,##0"/>
        </Style>
        <Style ss:ID="m00006">
            <Borders>
            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
            </Borders>
        </Style>
        <Style ss:ID="m00007">
            <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000" ss:Bold="1"/>
        </Style>
        <Style ss:ID="m00008">
            <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
            <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="12" ss:Color="#000000" ss:Bold="1"/>
        </Style>
    </Styles>
    <Worksheet ss:Name="Laporan">
        <Table ss:ExpandedColumnCount="13" ss:ExpandedRowCount="<?php echo $jumlah ?>" x:FullColumns="1"
               x:FullRows="1" ss:DefaultRowHeight="15">
            <Column ss:AutoFitWidth="0" ss:Width="31.5"/>
            <Column ss:AutoFitWidth="0" ss:Width="105"/>
            <Column ss:AutoFitWidth="0" ss:Width="47.25" ss:Span="10"/>
            <Row ss:AutoFitHeight="0">
                <Cell ss:StyleID="m00007"><Data ss:Type="String">TENTARA NASIONAL INDONESIA ANGKATAN DARAT</Data></Cell>
            </Row>
            <Row ss:AutoFitHeight="0">
                <Cell ss:StyleID="m00007"><Data ss:Type="String"><?php echo $kotama['ur_kotama'] ?></Data></Cell>
            </Row>
            <Row ss:Index="5" ss:AutoFitHeight="0">
                <Cell ss:MergeAcross="8" ss:StyleID="m00008"><Data ss:Type="String">REKAPITULASI PERUBAHAN KEKUATAN PRAJURIT TNI AD KOTAMA/BALAKPUS</Data></Cell>
            </Row>
            <Row ss:AutoFitHeight="0">
                <Cell ss:MergeAcross="8" ss:StyleID="m00008"><Data ss:Type="String">DAN PENDIDIKAN MILITER BULAN MEI TA. 2017</Data></Cell>
            </Row>
            <Row ss:Index="8" ss:AutoFitHeight="0">
                <Cell><Data ss:Type="String">Kesatuan : <?php echo $kotama['nama_kotama'] ?></Data></Cell>
            </Row>
            <Row ss:AutoFitHeight="0">
                <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">NO</Data></Cell>
                <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">PANGKAT</Data></Cell>
                <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">TOP</Data></Cell>
                <Cell ss:MergeAcross="4" ss:StyleID="m00001"><Data ss:Type="String">NYATA</Data></Cell>
                <Cell ss:MergeDown="2" ss:StyleID="m00001"><Data ss:Type="String">STATUS</Data></Cell>
            </Row>
            <Row ss:AutoFitHeight="0">
                <Cell ss:Index="4" ss:MergeDown="1" ss:StyleID="m00002"><Data ss:Type="String">DINAS AKTIF</Data></Cell>
                <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">MPP</Data></Cell>
                <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">LF</Data></Cell>
                <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">SKORSING</Data></Cell>
                <Cell ss:MergeDown="1" ss:StyleID="m00001"><Data ss:Type="String">JUMLAH</Data></Cell>
            </Row>
            <Row ss:AutoFitHeight="0"/>
            <Row ss:AutoFitHeight="0">
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">1</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">2</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">3</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">4</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">5</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">6</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">7</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">8</Data></Cell>
                <Cell ss:StyleID="m00001"><Data ss:Type="Number">9</Data></Cell>
            </Row>
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
            </Row>
            <?php if ($pangkat): ?>
                <?php $nomor = 1; ?>
                <?php foreach ($pangkat as $row) : ?>
                    <Row ss:AutoFitHeight="0">
                        <Cell ss:StyleID="m00003"><Data ss:Type="Number"><?php echo $nomor++ ?></Data></Cell>
                        <Cell ss:StyleID="m00004"><Data ss:Type="String"><?php echo strtoupper($row['ur_pangkat']) ?></Data></Cell>
                        <Cell ss:StyleID="m00005"/>
                        <Cell ss:StyleID="m00005"/>
                        <Cell ss:StyleID="m00005"/>
                        <Cell ss:StyleID="m00005"/>
                        <Cell ss:StyleID="m00005"/>
                        <Cell ss:StyleID="m00005" ss:Formula="=SUM(RC[-4]:RC[-1])"><Data ss:Type="Number">0</Data></Cell>
                        <Cell ss:StyleID="m00005" ss:Formula="=(RC[-6]-RC[-1])"><Data ss:Type="Number">0</Data></Cell>
                    </Row>
                <?php endforeach; ?>
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
            </Row>
            <?php echo $satminkal ?>
        </Table>
        <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
            <PageSetup>
                <Header x:Margin="0.3"/>
                <Footer x:Margin="0.3"/>
                <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
            </PageSetup>
            <Unsynced/>
            <Selected/>
            <ProtectObjects>False</ProtectObjects>
            <ProtectScenarios>False</ProtectScenarios>
            <AllowFormatCells/>
            <AllowSizeCols/>
            <AllowSizeRows/>
            <AllowInsertCols/>
            <AllowInsertRows/>
            <AllowInsertHyperlinks/>
            <AllowDeleteCols/>
            <AllowDeleteRows/>
            <AllowSort/>
            <AllowFilter/>
            <AllowUsePivotTables/>
        </WorksheetOptions>
        <DataValidation xmlns="urn:schemas-microsoft-com:office:excel">
            <Range>R14C3:R52C7,R71C3:R109C7</Range>
            <Type>Whole</Type>
            <Qualifier>GreaterOrEqual</Qualifier>
            <Value>0</Value>
        </DataValidation>
    </Worksheet>
</Workbook>
