// JavaScript Document
(function ($) {

    $.Pager = function (table, setting)
    {
        if (table.mygrid)
            return false; //return if already exist	

        // apply default properties
        setting = $.extend({
            url: false, //ajax url
            onError: false,
            afterload: function () {
            }
        }, setting);

        $(table).show();

        var thegrid = {
            currpage: function () {
                if (setting.pagercontainer)
                {
                    if ($('.pagedisplay', setting.pagercontainer).val() == '')
                    {
                        return 1;
                    } else
                    {
                        var arrstr = $('.pagedisplay', setting.pagercontainer).val().split('/');
                        return arrstr[0];
                    }
                } else
                    return 1;
            },
            rowperpage: function () {

                if (setting.pagercontainer)
                    return $('.pagesize', setting.pagercontainer).val();
                else
                    return 10;
            },
            loaddata: function (url, params) {
                this.getdata(url, params, table, setting.pagerloader);
            },
            loaddatapage: function (url, params) {
                this.getdata(url, params, setting.pagercontainer, setting.pagerloader);
            }
            ,
            getdata: function (url, params, hide, show) {
                $(hide).hide();
                $(show).show();

                var currpage = this.currpage(), rowperpage = this.rowperpage();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $.extend(params, {currpage: currpage, rowperpage: rowperpage}),
                    dataType: 'json',
                    success: function (data) {
                        var currentpage = data.currentpage, totalpage = Math.ceil(data.rowcount / data.rowperpage);

                        if ((currentpage > totalpage) && (totalpage != 0)) {
                            currentpage = totalpage;
                            data.currentpage = totalpage;
                        }

                        $('.pagedisplay', setting.pagercontainer).val(currentpage + '/' + totalpage);
                        $('form span.jumlahdata', setting.pagercontainer).remove();
                        $('form', setting.pagercontainer).append('<span class="jumlahdata">Total data : ' + data.rowcount + '</span>');

                        setting.loaddata(data);

                        setting.afterload();

                        $(hide).show();
                        $(show).hide();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        try {
                            if (setting.onError)
                                setting.onError(XMLHttpRequest, textStatus, errorThrown);
                        } catch (e) {
                        }
                    }
                });
            }
        }// end thegrid class

        $('.pagesize', setting.pagercontainer).change(function () {

            thegrid.loaddatapage(setting.url, setting.params);

        });

        $('.first', setting.pagercontainer).click(function () {

            var arrstr = $('.pagedisplay', setting.pagercontainer).val().split('/');
            $('.pagedisplay', setting.pagercontainer).val('1/' + arrstr[1]);
            thegrid.loaddatapage(setting.url, setting.params);

        });

        $('.prev', setting.pagercontainer).click(function () {

            var arrstr = $('.pagedisplay', setting.pagercontainer).val().split('/');

            if (arrstr[0] != '1')
            {

                $('.pagedisplay', setting.pagercontainer).val((parseInt(arrstr[0]) - 1) + '/' + arrstr[1]);
                thegrid.loaddatapage(setting.url, setting.params);
            }

        });

        $('.next', setting.pagercontainer).click(function () {

            var arrstr = $('.pagedisplay', setting.pagercontainer).val().split('/');

            if (arrstr[0] != arrstr[1])
            {

                $('.pagedisplay', setting.pagercontainer).val((parseInt(arrstr[0]) + 1) + '/' + arrstr[1]);
                thegrid.loaddatapage(setting.url, setting.params);
            }


        });

        $('.last', setting.pagercontainer).click(function () {

            var arrstr = $('.pagedisplay', setting.pagercontainer).val().split('/');

            if (arrstr[0] != arrstr[1])
            {

                $('.pagedisplay', setting.pagercontainer).val(arrstr[1] + '/' + arrstr[1]);
                thegrid.loaddatapage(setting.url, setting.params);
            }

        });

        //make accessible
        table.setting = setting;
        table.mygrid = thegrid;

        // load data
        if ((setting.url == '') || (setting.url == ' '))
        {
            //nothing
        } else
        {
            thegrid.loaddata(setting.url, setting.params);
        }

        return table;

    };

    var docloaded = false;

    $(document).ready(function () {
        docloaded = true
    });

    $.fn.lwspager = function (setting) {

        return this.each(function () {
            if (!docloaded)
            {
                $(this).hide();
                var table = this;
                $(document).ready(function () {
                    $.Pager(table, setting);
                });
            } else {
                $.Pager(this, setting);
            }
        });

    }; //end lwspager


    $.fn.Reload = function (p) { // function to reload grid
        return this.each(function () {
            if (this.mygrid && this.setting.url)
            {
                $.extend(this.setting, p);
                this.mygrid.loaddata(this.setting.url, this.setting.params);
            }
        });

    }; //end Reload

    $.fn.Options = function (p) { //function to update general options

        return this.each(function () {
            if (this.mygrid)
                $.extend(this.setting, p);
        });

    }; //end Options

})(jQuery);