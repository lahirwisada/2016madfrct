<script type="text/javascript">

    $(document).ready(function () {
        $("#add-dasar-spt").click(function (e) {
            e.preventDefault();

            var textDasar = $("#txt-dasar").val();

            if (textDasar != "") {
                var aGroupItem = $("<a href=\"javascript:void(0);\" class=\"list-group-item\"></a>"),
                        spanTitleDasar = $("<span class=\"list-title-dasar\"></span>"),
                        pDasar = $("<p></p>"),
                        btnRemoveDasar = $("<button type=\"button\" class=\"btn-remove-list btn btn-sm btn-default pull-right\"><span class=\"fa fa-trash-o\"></span></button>"),
                        inpBoxDasar = $("<input type=\"hidden\" class=\"inp-spt-dasar\" name=\"spt_dasar[]\" />");

                $(inpBoxDasar).val(textDasar);
                $(spanTitleDasar).text(textDasar);
                $(pDasar).append(spanTitleDasar);
                $(pDasar).append(btnRemoveDasar);
                $(aGroupItem).append(pDasar);
                $(aGroupItem).append(inpBoxDasar);

                $("#daftar-dasar").append(aGroupItem);

                $(btnRemoveDasar).click(eventRemoveListItem);

                aGroupItem = undefined;
                spanTitleDasar = undefined;
                pDasar = undefined;
                btnRemoveDasar = undefined;
                inpBoxDasar = undefined;
                $("#txt-dasar").val("");
            }
        });
    });
</script>