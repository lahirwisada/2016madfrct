<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script type="text/javascript">

    var tabPersyaratanDiklat = {
        idTable: '',
        init: function () {
            var self = this;

            $("#add-persyaratan_diklat").click(self.tambahData);

            $("#DataTables_Table_persyaratan_diklat tbody").sortable({
                items: "> tr",
                appendTo: "parent",
                helper: "clone"
            }).disableSelection();

<?php if ($detail && $detail->persyaratan_diklat): ?>

    <?php foreach ($detail->persyaratan_diklat as $key => $persyaratan_diklat): ?>
                    self.__addRow({
                        uraian: "<?php echo $persyaratan_diklat->uraian ?>",
                        level: "<?php echo $persyaratan_diklat->level ?>"
                    });
    <?php endforeach; ?>
<?php endif; ?>

        },
        __addRow: function (dataRow) {
            var tblTr = $("<tr class=\"tr-persyaratan-diklat\"></tr>"), tblTdUraian = $("<td></td>"), tblTdAksi = $("<td></td>");

            var btnGroup = $("<div class=\"btn-group btn-group-sm\"></div>");

            var btnEdit = $("<a></a>");
            var btnRemove = $("<a></a>");

            var self = this;

            btnRemove.click(function () {

                var selfBtn = this;
                modalConfirm({
                    id: 'message-box-confirm',
                    title: 'Mohon Perhatian',
                    msg: 'Anda yakin akan menghapus berkas ini?',
                    onOk: function () {
                        $(selfBtn).parent().parent().parent().remove();
                    }
                });

                return false;
            });

            btnEdit.click(function () {


                var selfBtn = this, dataRow = $(selfBtn).parent().parent().parent().data();

                modalConfirm({
                    id: 'message-box-confirm',
                    title: 'Mohon Perhatian',
                    msg: 'Anda akan melakukan pengubahan data, sebelum mengakhiri pastikan anda menekan tombol tambah, Baik setelah mengubah data atau batal mengubah data.<br />Anda yakin akan melanjutkan?',
                    onOk: function () {
                        $(selfBtn).parent().parent().parent().remove();
                        self.editData(dataRow);
                    }
                });

                return false;
            });

            btnEdit.addClass("btn").addClass("btn-default").addClass("editRowPersyaratanDiklat").attr("href", "#").text("Ubah");
            btnRemove.addClass("btn").addClass("btn-default").addClass("btn-hapus-row").addClass("removeRowPersyaratanDiklat").attr("href", "#").text("Hapus");

            btnGroup.append(btnEdit).append(btnRemove);

//            tblTdAksi.html(btnGroup);
            tblTdAksi.append(btnGroup);

            var txtIndent = 0;
            for (var i = 1; i < dataRow.level; i++) {
                txtIndent += 1;
            }

            var uraianText = "<div style=\"text-indent: " + txtIndent + "em;\">" + dataRow.uraian + "</div>";

            tblTdUraian.html(uraianText);
            tblTr.append(tblTdUraian);
            tblTr.append(tblTdAksi);

            tblTr.data(dataRow);
            
            $("#DataTables_Table_persyaratan_diklat tbody:last").append(tblTr);
        },
        __removeRow: function (remBtnInstance) {
            var self = remBtnInstance;
            $(self).parent().parent().parent().remove();
        },
        collectData: function () {

            var dataPersyaratanDiklat = [];
            $("tr.tr-persyaratan-diklat").each(function () {
                var dataRow = $(this).data();
                dataPersyaratanDiklat.push({level: dataRow.level, uraian: dataRow.uraian});
                dataRow = undefined;
            });

            return dataPersyaratanDiklat;
        },
        editData: function (dataRow) {
            $("#txtarea-persyaratan_diklat").val(dataRow.uraian);
            $("#slc-level_persyaratan_diklat").val(dataRow.level);
        },
        reset: function () {
            $("#txtarea-persyaratan_diklat").val("");
        },
        tambahData: function () {

            var formPersyaratanDiklat = {
                uraian: $("#txtarea-persyaratan_diklat").val(),
                level: $("#slc-level_persyaratan_diklat").val()
            };

            if (formPersyaratanDiklat.uraian.trim() == "") {
                return false;
            }

            tabPersyaratanDiklat.__addRow(formPersyaratanDiklat);

            tabPersyaratanDiklat.reset(formPersyaratanDiklat);
        }
    };

    $(document).ready(function () {
        tabPersyaratanDiklat.init();
    });

</script>