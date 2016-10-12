<script type="text/javascript">
    $(document).ready(function () {

        $("#add-tembusan").click(function (e) {
            e.preventDefault();

            var textTembusan = $("#txt-tembusan").val();

            if (textTembusan != "") {
                var aGroupItem = $("<a href=\"javascript:void(0);\" class=\"list-group-item\"></a>"),
                        spanTitleTembusan = $("<span class=\"list-title-tembusan\"></span>"),
                        pTembusan = $("<p></p>"),
                        btnRemoveTembusan = $("<button type=\"button\" class=\"btn-remove-list btn btn-sm btn-default pull-right\"><span class=\"fa fa-trash-o\"></span></button>"),
                        inpBoxTembusan = $("<input type=\"hidden\"  class=\"inp-spt-tembusan\" name=\"spt_tembusan[]\" />");

                $(inpBoxTembusan).val(textTembusan);
                $(spanTitleTembusan).text(textTembusan);
                $(pTembusan).append(spanTitleTembusan);
                $(pTembusan).append(btnRemoveTembusan);
                $(aGroupItem).append(pTembusan);
                $(aGroupItem).append(inpBoxTembusan);

                $("#daftar-tembusan").append(aGroupItem);

                $(btnRemoveTembusan).click(eventRemoveListItem);

                aGroupItem = undefined;
                spanTitleTembusan = undefined;
                pTembusan = undefined;
                btnRemoveTembusan = undefined;
                inpBoxTembusan = undefined;
                $("#txt-tembusan").val("");
            }
        });
    });
</script>