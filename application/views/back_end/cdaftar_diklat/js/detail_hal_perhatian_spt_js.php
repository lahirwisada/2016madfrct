<?php
$detail = isset($detail) ? $detail : FALSE;
?>
<script type="text/javascript">

    var tabHalPerhatianSpt = {
        idTable: '',
        init: function () {
            var self = this;

            $("#add-hal_perhatian_spt").click(self.tambahData);

            $("#DataTables_Table_hal_perhatian_spt tbody").sortable({
                items: "> tr",
                appendTo: "parent",
                helper: "clone"
            }).disableSelection();

<?php if ($detail && $detail->hal_perhatian): ?>

    <?php foreach ($detail->hal_perhatian as $key => $hal_perhatian): ?>
                    self.__addRow({
                        uraian: "<?php echo $hal_perhatian->uraian ?>",
                        level: "<?php echo $hal_perhatian->level ?>"
                    });
    <?php endforeach; ?>
<?php endif; ?>

        },
        __addRow: function (dataRow) {
            var tblTr = $("<tr class=\"tr-hal-perhatian\"></tr>"), tblTdUraian = $("<td></td>"), tblTdAksi = $("<td></td>");

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

            btnEdit.addClass("btn").addClass("btn-default").addClass("editRowHalPerhatianSpt").attr("href", "#").text("Ubah");
            btnRemove.addClass("btn").addClass("btn-default").addClass("btn-hapus-row").addClass("removeRowHalPerhatianSpt").attr("href", "#").text("Hapus");

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

            $("#DataTables_Table_hal_perhatian_spt tbody:last").append(tblTr);
        },
        __removeRow: function (remBtnInstance) {
            var self = remBtnInstance;
            $(self).parent().parent().parent().remove();
        },
        collectData: function () {

            var dataHalPerhatian = [];
            $("tr.tr-hal-perhatian").each(function () {
                var dataRow = $(this).data();
                dataHalPerhatian.push({level: dataRow.level, uraian: dataRow.uraian});
                dataRow = undefined;
            });

            return dataHalPerhatian;
        },
        editData: function (dataRow) {
            $("#txtarea-hal_perhatian").val(dataRow.uraian);
            $("#slc-level_hal_perhatian_spt").val(dataRow.level);
        },
        reset: function () {
            $("#txtarea-hal_perhatian").val("");
        },
        tambahData: function () {

            var formHalPerhatian = {
                uraian: $("#txtarea-hal_perhatian").val(),
                level: $("#slc-level_hal_perhatian_spt").val()
            };

            if (formHalPerhatian.uraian.trim() == "") {
                return false;
            }

            tabHalPerhatianSpt.__addRow(formHalPerhatian);

            tabHalPerhatianSpt.reset(formHalPerhatian);
        }
    };

    $(document).ready(function () {
        tabHalPerhatianSpt.init();
    });

</script>