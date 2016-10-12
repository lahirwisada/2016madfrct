// JavaScript Document
(function ($) {
    var docgridhelper = false;

    $(document).ready(function () {
        docgridhelper = true
    });

    $.fn.lwsgrid = function (setting) {

        return this.each(function () {
            if (!docgridhelper)
            {
                //$(this).hide();
                var divgridcontainer = this;

                $(document).ready(function () {
                    $.Initialize_grid_helper(divgridcontainer, setting);
                });
            } else {
                $.Initialize_grid_helper(this, setting);
            }
        });

    };

    $.fn.get_setting = function (attr) { // function to reload control

        var temp;
        this.each(function () {
            temp = eval('this.setting.' + attr);

        });

        return temp;
    };

    $.fn.reload_grid = function (p) { // function to reload control
        return this.each(function () {
            if (this.setting.url)
            {
                this.setting = $.extend(this.setting, p);
                this.grid.reload_paging();
            }
        });

    }; //end Reload

    $.fn.reload_header = function (p) { // function to reload control
        return this.each(function () {
            this.setting = $.extend(this.setting, p);
            this.grid.reload_header();
        });

    }; //end Reload

    $.fn.update_grid_row = function (fields, key) { // function to update
        return this.each(function () {

            this.grid.update_row(fields, key);
        });

    }; //end update row

    $.fn.remove_grid_row = function (key) { // function to update
        return this.each(function () {

            this.grid.remove_row(key);
        });

    }; //end update row

    $.fn.urut_ulang_nomor_row = function () { // function to urut_ulang_nomor_row
        return this.each(function () {

            this.grid.urut_ulang_nomor();
        });

    }; //end urut_ulang_nomor_row

    $.fn.Pilih = function (key) { // function to reload control

        return this.each(function () {

            this.grid.pilih(key);
        });

    }; //end update row


//	$.fn.Options = function(p) { //function to update general options
//
//		return this.each( function() {
//				if (this.autosuggest) $.extend(this.setting,p);
//			});
//
//	}; //end Options


    $.Initialize_grid_helper = function (divgridcontainer, setting)
    {
        // apply default properties
        setting = $.extend({
            url: false, //ajax url
            params: {},
            show_aksi: true,
            buttonlayout: 'vertical', //'horizontal','vertical',
            modulname: '',
            aksi_width: '280px',
            carivisible: false,
            controller: '',
            show_slcActive: '',
            text_pilih: 'pilih',
            text_tidak_pilih: 'batal',
            columns: [],
            keycolumn: {column: '', type: 'txt'},
            container: $(divgridcontainer).attr('id'),
            advanced_header: false,
            advanced_row: false,
            header: [],
            buttons: [
                {name: 'pilih', js: 'Pilih', "class": "pilih", span: "ui-icon-check", show: true, state: "active", parameter: "\"[key]\""},
                {name: 'ubah', js: 'Ubah', "class": "update", span: "ui-icon-pencil", show: true, state: "both", parameter: "\"[key]\""},
                {name: 'hapus', js: 'Hapus', "class": "delete", span: "ui-icon-close", show: true, state: "active", parameter: "\"[key]\""},
                {name: 'kembalikan', js: 'Kembalikan', "class": "delete", span: "ui-icon-arrowthick-1-n", show: true, state: "inactive", parameter: "\"[key]\""}
            ],
            topbuttons: [
//                              { name : 'Tambah', id : 'btnNew', span : "ui-icon-plus", show : true, access : "IS_WRITE"},
                {name: 'Refresh', id: 'btnRefresh', span: "ui-icon-refresh", show: true, access: "ALL", onclick: ''},
                {name: 'Cari', id: 'btnCari', span: "ui-icon-search", show: true, access: "ALL", onclick: ''}
            ],
            afterload: function () {/*alert('loaded');*/
            }
        }, setting);

        var thisgrid = {
            apply_default_properties: function ()
            {
                for (var i in setting.columns)
                {
                    if (setting.advanced_row)
                    {
                        for (var j in setting.columns[i])
                        {
                            setting.columns[i][j] = $.extend(
                                    {
                                        column: '',
                                        header: '',
                                        display_fields: true,
                                        display: true,
                                        align: 'left',
                                        showless: false,
                                        showless_length: 45,
                                        width: '100px',
                                        grid_column_align: 'left',
                                        grid_column_width: '150px'
                                    }
                            , setting.columns[i][j]);
                        }
                    } else
                    {
                        setting.columns[i] = $.extend(
                                {
                                    column: '',
                                    header: '',
                                    sorting: true,
                                    group: false, //group
                                    display_fields: true,
                                    display: true,
                                    single_data: true,
                                    column_formula: '',
                                    simpan: true,
                                    type: 'txt',
                                    align: 'left',
                                    showless: false,
                                    showless_length: 45,
                                    validation: '',
                                    width: '100px',
                                    maxlength: '',
                                    minlength: '',
                                    grid_column_align: 'left',
                                    grid_column_width: '150px'
                                }
                        , setting.columns[i]);
                    }

                }

                for (var i in setting.header)
                {
                    if (setting.advanced_header)
                    {
                        for (var j in setting.header[i])
                        {
                            setting.header[i][j] = $.extend(
                                    {
                                        sorting: true,
                                        field: ''

                                    }
                            , setting.header[i][j]);
                        }
                    }
                }

                // end apply default properties
            },
            init_buttons: function ()
            {

                //return this.each( function() {

                var strhtml = '';
                var IS_WRITE = $('#IS_WRITE').val();

                strhtml += '<p>&nbsp;</p>';

                for (var i in setting.topbuttons)
                {
                    if ((((setting.topbuttons[i].access == "IS_WRITE") && (IS_WRITE == 'true')) || (setting.topbuttons[i].access == "ALL")) && (setting.topbuttons[i].show == true))
                        strhtml += "<a href='#' style='float:left; margin: 5px;' id='" + setting.topbuttons[i].id + setting.modulname + "' class='tombol ui-state-default ui-corner-all' onclick='" + setting.topbuttons[i].onclick + "return false;' ><span class='ui-icon " + setting.topbuttons[i].span + "'></span>" + setting.topbuttons[i].name + "</a>&nbsp;&nbsp;";
                }

                if (setting.carivisible)
                {

                    strhtml += '<div style="float:left;" id="divSearch' + setting.modulname;
                    strhtml += '" class="">';

                    strhtml += '    <table cellpadding="3">';
                    strhtml += '        <tr valign="middle">';
                    strhtml += '            <td>Keyword</td>';
                    strhtml += '            <td >';
                    strhtml += '                <input id="txtKeyword' + setting.modulname + '" type="text" style="width:200px" class="required text ui-widget-content ui-corner-all"/>';
                    strhtml += '                <select id="slcActive' + setting.modulname + '" class="pagesize select ui-widget-content ui-corner-all ' + setting.show_slcActive + '">';
                    strhtml += '                    <option value="all">All</option>';
                    strhtml += '                    <option selected="selected" value="active">Active</option>';
                    strhtml += '                    <option value="inactive">Inactive</option>';
                    strhtml += '                </select>';
                    strhtml += '                <a href="#" id="btnCariButton' + setting.modulname + '" class="tombol ui-state-default ui-corner-all" onclick="return false;" ><span class="ui-icon ui-icon-search"></span>Go</a>';
                    strhtml += '            </td>';
                    strhtml += '        </tr> ';
                    strhtml += '    </table>';
                    strhtml += '</div>';
                    strhtml += '<p>&nbsp;</p><br/>';
                }

                $('#' + setting.container).append(strhtml);

                $("#btnRefresh" + setting.modulname).click(function () {
                    thisgrid.reload_paging();
                });

                $("#btnCari" + setting.modulname).click(function () {
                    $("#divSearch" + setting.modulname).animate({"height": "toggle"}, {duration: 500});
                    $("#txtKeyword" + setting.modulname).val('');
                });

                $('#btnCariButton' + setting.modulname).click(function () {
                    thisgrid.reload_paging();
                });

                $("#txtKeyword" + setting.modulname).keypress(function (e) {
                    if (e.which == 13)
                        thisgrid.reload_paging();
                });

                $("#txtKeyword" + setting.modulname).keyup(function (e) {
                    thisgrid.reload_paging();
                });
                //});
            },
            reload_header: function ()
            {
                this.apply_default_properties();
                this.init_header(setting);
            },
            reload_paging: function ()
            {
                var keyword = $('#txtKeyword' + setting.modulname).val(),
                        isActive = $('#slcActive' + setting.modulname).val();

                $('#tlist' + setting.modulname).Reload
                        ({
                            url: setting.url,
                            params: $.extend({'keyword': keyword, 'state_active': isActive}, setting.params)
                        });

            },
            init_grid: function () {
                this.create_grid(setting);
                this.init_header(setting);

                $('#tlist' + setting.modulname).lwspager
                        ({
                            url: setting.url,
                            loaddata: this.load_paging,
                            /**
                             * @deprecated since 5-Agustus-2016 by lahir wisada
                             * 
                             * Aktif seharusnya berisi active bukan state_active
                             */
//                            params: $.extend({'keyword': '', 'state_active': 'state_active'}, setting.params),
                            params: $.extend({'keyword': '', 'state_active': 'active'}, setting.params),
                            pagerloader: $("#tlist-load" + setting.modulname),
                            pagercontainer: $("#tlist-pager" + setting.modulname)
                                    //afterload : setting.afterload
                        });
            },
            load_paging: function (mydata)
            {
                var data = mydata.result;
                var IS_UPDATE = $('#IS_UPDATE').val(), IS_DELETE = $('#IS_DELETE').val();

                $('#tlist-body' + setting.modulname).html('');

                var strbody = '';

                var id_group_now = '', group_count = 1, group_field = '';//group

                for (var i in data)
                {
                    var nomor = (parseInt(i) + (parseInt(mydata.currentpage) * parseInt(mydata.rowperpage))) - parseInt(mydata.rowperpage) + 1,
                            tbuttons = "", my_fields = "";

                    var key = data[i][setting.keycolumn.column];

                    if (setting.advanced_row)
                    {


                        for (var j in setting.columns)
                        {
                            strbody += "<tr id='row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname + "_" + j + "' class='list_row" + setting.modulname + " row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname + "' " + setting.keycolumn.column + "='" + data[i][setting.keycolumn.column] + "'>";


                            if (j == 0)
                                strbody += "<td style='text-align:center;vertical-align:top;width:20px;' rowspan='" + setting.columns.length + "' colspan='1'>" + nomor + "</td>";


                            for (var k in setting.columns[j])
                            {

                                tbuttons = thisgrid.table_buttons("active", setting.columns[j][k].column).replace(/\[key]/g, key);

                                my_fields = setting.columns[j][k].column_formula;



                                for (var l in data[i])
                                {
                                    var re = new RegExp("\\[" + l + "]", "g");


                                    my_fields = (setting.columns[j][k].display_fields) ? my_fields.replace(re, data[i][l]) : "";

                                    tbuttons = tbuttons.replace(re, data[i][l]);
                                }

                                if (setting.columns[j][k].display)
                                {

                                    strbody += "<td style='text-align:" + setting.columns[j][k].grid_column_align + "; vertical-align:top; width:" + setting.columns[j][k].grid_column_width + ";' colspan='" + setting.columns[j][k].colspan + "' rowspan='" + setting.columns[j][k].rowspan + "'>" + my_fields + tbuttons + "</td>";
                                }

                            }



                            if ((j == 0) && (setting.show_aksi))
                            {
                                strbody += '<th style="text-align:center;" rowspan="' + setting.header.length + '" colspan="1" >Aksi</th>';

                                if (data[i].record_active == "1")
                                {
                                    tbuttons = thisgrid.table_buttons("active", "").replace(/\[key]/g, key);
                                } else
                                {
                                    tbuttons = thisgrid.table_buttons("inactive", "").replace(/\[key]/g, key);
                                }

                                for (var k in data[i])
                                {
                                    var re = new RegExp("\\[" + k + "]", "g");
                                    tbuttons = tbuttons.replace(re, data[i][k]);
                                }

                                strbody += "<td style='text-align:left;vertical-align:top; width:" + setting.aksi_width + ";'>" + tbuttons + "</td>";


                            }

                            strbody += "</tr>";
                        }

                        $('#tlist-body' + setting.modulname).append(strbody);
                        strbody = "";

                        $(".row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname).data('data', data[i]);
                    } else
                    {
                        strbody += "<tr id='row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname + "' class='list_row" + setting.modulname + " row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname + "' " + setting.keycolumn.column + "='" + data[i][setting.keycolumn.column] + "'>";
                        strbody += "<td style='text-align:center;vertical-align:top;width:20px;'>" + nomor + "</td>";
                        //grid column

                        for (var j in setting.columns)
                        {
                            var tempUniqueId = Math.round(new Date().getTime() / 1000) + Math.floor(Math.random()) + parseInt(i), addID = setting.columns[j].column;
                            tbuttons = thisgrid.table_buttons("active", setting.columns[j].column).replace(/\[key]/g, key);

                            if (setting.columns[j].single_data)
                            {
                                my_fields = (setting.columns[j].display_fields) ? data[i][setting.columns[j].column] : "";
                            } else
                            {
                                my_fields = setting.columns[j].column_formula;

                                for (var k in data[i])
                                {
                                    var re = new RegExp("\\[" + k + "]", "g");


                                    my_fields = (setting.columns[j].display_fields) ? my_fields.replace(re, data[i][k]) : "";
                                }
                            }

                            //                                            for ( var k in setting.columns )
                            //                                            {
                            //                                                var re = new RegExp("\\[" + setting.columns[k].column + "]", "g");
                            //                                                tbuttons = tbuttons.replace(re,data[i][setting.columns[k].column]);
                            //                                            }

                            for (var k in data[i])
                            {
                                var re = new RegExp("\\[" + k + "]", "g");
                                tbuttons = tbuttons.replace(re, data[i][k]);
                            }

                            if (setting.columns[j].group)//group
                            {
                                if (id_group_now != data[i][setting.keycolumn.column])
                                {
                                    $('.group_' + id_group_now).attr('rowspan', group_count);

                                    group_field = my_fields;
                                    id_group_now = data[i][setting.keycolumn.column];
                                    group_count = 1;
                                } else
                                {
                                    if (group_field == my_fields)
                                    {
                                        group_count += 1;
                                    }
                                }
                            }

                            if ((setting.columns[j].display) && ((!setting.columns[j].group) || (group_count == 1)))//group
                            {
                                var group_class = '', cellContent = my_fields + tbuttons;

                                if (setting.columns[j].group)
                                    group_class = 'group_' + data[i][setting.keycolumn.column];

                                if (setting.columns[j].showless) {
                                    var arrCellContent = cellContent.split(" ");
                                    if (arrCellContent.length > setting.columns[j].showless_length) {
                                        cellContent = "<div class=\"lws-cell-more-content\"><div id=\"less_content_" + tempUniqueId + "_" + addID + "\" class=\"less_content_" + tempUniqueId + "_" + addID + " lws-show-more\" style=\"\">" + cellContent + "</div><div id=\"show-less-div-" + tempUniqueId + "_" + addID + "\" class=\"lws-cell-show-more\" style=\"cursor: pointer;\" onclick=\"masterGridShowMoreCell.onClick(" + tempUniqueId + "," + "'" + addID + "'" + ");\"><span style=\"color:#CC0000\">More...</span></div></div>";
                                    }
                                    arrCellContent = new Array();
                                }

                                strbody += "<td style='text-align:" + setting.columns[j].grid_column_align + "; vertical-align:top; width:" + setting.columns[j].grid_column_width + ";' class='" + group_class + "'>" + cellContent + "</td>";
                            }

                        }

                        $('.group_' + id_group_now).attr('rowspan', group_count);//group //for last row group
                        //end grid column

                        if (data[i].record_active == "1")
                        {
                            tbuttons = thisgrid.table_buttons("active", "").replace(/\[key]/g, key);
                        } else
                        {
                            tbuttons = thisgrid.table_buttons("inactive", "").replace(/\[key]/g, key);
                        }

                        //                                        for ( var k in setting.columns )
                        //                                        {
                        //                                            var re = new RegExp("\\[" + setting.columns[k].column + "]", "g");
                        //                                            tbuttons = tbuttons.replace(re,data[i][setting.columns[k].column]);
                        //                                        }

                        for (var k in data[i])
                        {
                            var re = new RegExp("\\[" + k + "]", "g");
                            tbuttons = tbuttons.replace(re, data[i][k]);
                        }
                        if (setting.show_aksi)
                            strbody += "<td style='text-align:left;vertical-align:top; width:" + setting.aksi_width + ";'>" + tbuttons + "</td>";
                        strbody += "</tr>";

                        $('#tlist-body' + setting.modulname).append(strbody);
                        strbody = "";

                        $("#row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname).data('data', data[i]);
                    }

                    var the_row_class = ".row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname;

                    $(the_row_class).hover(function () {
                        $(".row_" + $(this).attr(setting.keycolumn.column) + "_" + setting.modulname).addClass("ui-state-highlight");
                    }, function () {
                        $(".row_" + $(this).attr(setting.keycolumn.column) + "_" + setting.modulname).removeClass("ui-state-highlight");
                    });
                }

                //$('#tlist-body'+setting.modulname).html(strbody);

                if (IS_UPDATE == 'false') {
                    $('.update').show();
                    $('a.update').text('lihat').append("<span class='ui-icon ui-icon-zoomin'></span>");
                    $('input.update').attr('disabled', true);
                } else
                    $('.update').show();
                if (IS_DELETE == 'false')
                    $('.delete').hide();
                else
                    $('.delete').show();



                $('#tlist' + setting.modulname).show();
                $('#tlist-load' + setting.modulname).hide();

                $('.list_row' + setting.modulname).each(function (index) {
                    var key_value = $(this).attr(setting.keycolumn.column);

                    if ($("#data" + setting.modulname).data(key_value))
                    {
                        $('.pilih' + setting.modulname, '#row_' + key_value + '_' + setting.modulname).html('<span class="ui-icon ui-icon-cancel"></span> tidak pilih');
                        thisgrid.markselected('row_' + key_value + '_' + setting.modulname);
                    }

                });

                thisgrid.update_jumlah_dipilih();

                setting.afterload();
            },
            init_header: function (setting)
            {
                if (!setting.advanced_header)
                {
                    $('#tlist-head' + setting.modulname).html('');

                    var strbody = '';

                    strbody += '<tr class="ui-widget-header"><th style="text-align:center;">No</th>';
                    for (var i in setting.columns)
                    {
                        if (setting.columns[i].display)
                        {
                            var text_header = setting.columns[i].header;

                            if (setting.columns[i].sorting)
                                text_header = '<a href="#" field="' + setting.columns[i].column + '" class="sorting' + setting.modulname + ' tombol " style="white-space:nowrap; color:white; font-weight:bold;" onclick="return false;" title="' + setting.columns[i].header + '" ><span class="ui-icon ui-icon-triangle-2-n-s"></span>' + setting.columns[i].header + '</a>';

                            strbody += '<th style="text-align:' + setting.columns[i].align + ';">' + text_header + '</th>';
                        }
                    }

                    if (setting.show_aksi)
                        strbody += '<th style="text-align:center;">Aksi</th></tr>';

                    $('#tlist-head' + setting.modulname).html(strbody);
                } else
                {
                    $('#tlist-head' + setting.modulname).html('');

                    var strbody = '';

                    for (var i in setting.header)
                    {
                        strbody += '<tr class="ui-widget-header">';


                        if (i == 0)
                            strbody += '<th style="text-align:center;" rowspan="' + setting.header.length + '" colspan="1" >No.</th>';

                        for (var j in setting.header[i])
                        {
                            var text_header = setting.header[i][j].name;

                            if (setting.header[i][j].sorting)
                                text_header = '<a href="#" field="' + setting.header[i][j].field + '" class="sorting' + setting.modulname + ' tombol " style="white-space:nowrap; color:white; font-weight:bold;" onclick="return false;" title="' + setting.header[i][j].name + '" ><span class="ui-icon ui-icon-triangle-2-n-s"></span>' + setting.header[i][j].name + '</a>';


                            strbody += '<th style="text-align:center;" rowspan="' + setting.header[i][j].rowspan + '" colspan="' + setting.header[i][j].colspan + '" >' + text_header + '</th>';

                        }

                        if ((i == 0) && (setting.show_aksi))
                            strbody += '<th style="text-align:center;" rowspan="' + setting.header.length + '" colspan="1" >Aksi</th>';

                    }

                    $('#tlist-head' + setting.modulname).html(strbody);

                }

                $('.sorting' + setting.modulname).click(function () {

                    var sorting = [];

                    if ($('span', this).hasClass('ui-icon-triangle-2-n-s'))
                    {
                        $(this).attr('title', $(this).text() + " " + "asc");
                        $('span', this).removeClass('ui-icon-triangle-2-n-s').addClass('ui-icon-triangle-1-s');
                    } else if ($('span', this).hasClass('ui-icon-triangle-1-s'))
                    {
                        $(this).attr('title', $(this).text() + " " + "desc");
                        $('span', this).removeClass('ui-icon-triangle-1-s').addClass('ui-icon-triangle-1-n');

                    } else if ($('span', this).hasClass('ui-icon-triangle-1-n'))
                    {
                        $(this).attr('title', $(this).text());
                        $('span', this).removeClass('ui-icon-triangle-1-n').addClass('ui-icon-triangle-2-n-s');
                    }

                    $('a.sorting' + setting.modulname).each(function (index) {
                        if ($('span', this).hasClass('ui-icon-triangle-2-n-s'))
                        {
                            //do nothing
                        } else if ($('span', this).hasClass('ui-icon-triangle-1-s'))
                        {
                            sorting.push({
                                sort_field: $(this).attr('field'),
                                sort_way: 'asc'
                            });

                        } else if ($('span', this).hasClass('ui-icon-triangle-1-n'))
                        {
                            sorting.push({
                                sort_field: $(this).attr('field'),
                                sort_way: 'desc'
                            });
                        }
                    });

                    setting.params = $.extend(setting.params, {
                        sort: sorting
                    });

                    thisgrid.reload_paging();
                });
            },
            create_grid: function (setting)
            {
                var strhtml = '';
                strhtml += '<table id="tlist' + setting.modulname + '" class="ui-widget ui-widget-content" cellpadding="4" cellspacing="0">';
                strhtml += '    <thead id="tlist-head' + setting.modulname + '">';
                strhtml += '    </thead>';
                strhtml += '    <tbody id="tlist-body' + setting.modulname + '">';
                strhtml += '    </tbody>';
                strhtml += '</table>';
                strhtml += '<div id="tlist-load' + setting.modulname + '" class="hidden"><img src="' + GetImagePath() + '/bar-loader.gif" /></div>';
                strhtml += '<div id="tlist-pager' + setting.modulname + '" class="pager">';
                strhtml += '    <form>';
                strhtml += '        <img src="' + GetImagePath() + '/icons/navigate_left2-red.png" class="first"/>';
                strhtml += '        <img src="' + GetImagePath() + '/icons/navigate_left-red.png" class="prev"/>';
                strhtml += '        <input type="text" style="width:100px;" readonly="readonly"  class="pagedisplay text ui-widget-content ui-corner-all"/>';
                strhtml += '        <img src="' + GetImagePath() + '/icons/navigate_right-red.png" class="next"/>';
                strhtml += '        <img src="' + GetImagePath() + '/icons/navigate_right2-red.png" class="last"/>';
                strhtml += '        &nbsp;&nbsp;';
                strhtml += '        <select class="pagesize select ui-widget-content ui-corner-all">';
                strhtml += '            <option selected="selected" value="5">5</option>';
                strhtml += '            <option  value="10">10</option>';
                strhtml += '            <option value="20">20</option>';
                strhtml += '            <option value="30">30</option>';
                strhtml += '            <option value="40">40</option>';
                strhtml += '            <option  value="50">50</option>';
                strhtml += '            <option value="60">60</option>';
                strhtml += '            <option value="70">70</option>';
                strhtml += '            <option value="80">80</option>';
                strhtml += '            <option value="90">90</option>';
                strhtml += '            <option value="100">100</option>';
                strhtml += '        </select>';
                strhtml += '    </form>';
                strhtml += '</div>';
                strhtml += '<p id="data' + setting.modulname + '">&nbsp;</p>';

                //$('#' + setting.container + setting.modulname).append(strhtml);
                $('#' + setting.container).append(strhtml);
            },
            table_buttons: function (state, column)
            {
                var strhtml = "", strbuttonlayout = "&nbsp;&nbsp;", my_column = "";

                if (setting.buttonlayout == "vertical")
                    strbuttonlayout = "<p></p>";

                for (var i in setting.buttons)
                {
                    my_column = (setting.buttons[i].column) ? setting.buttons[i].column : "";

                    if (((setting.buttons[i].state == state) || (setting.buttons[i].state == "both")) && (setting.buttons[i].show == true) && (my_column == column))
                    {
                        strhtml += "<a href='#' class='" + setting.buttons[i]["class"] + " tombol " + setting.buttons[i]["class"] + setting.modulname + "' onclick='" + setting.buttons[i].js + setting.modulname + "(" + setting.buttons[i].parameter + ");";
                        strhtml += "$(\".list_row" + setting.modulname + "\").removeClass(\"ui-state-active\");";
                        strhtml += "$(\".row_[key]_" + setting.modulname + "\").addClass(\"ui-state-active\");";
                        strhtml += " return false;' ><span class='ui-icon " + setting.buttons[i].span + "'></span>" + setting.buttons[i].name + "</a>" + strbuttonlayout;
                    }
                }

                return strhtml;
            },
            update_row: function (fields, key)
            {
                var counter = 1;
                for (var i in setting.columns)
                {
                    if (setting.columns[i].display)
                    {
                        if (setting.columns[i].single_data)
                        {
                            $('#row_' + key + "_" + setting.modulname + ' td:eq(' + counter + ')').text(fields[setting.columns[i].column]);
                        } else
                        {
                            var col_text = setting.columns[i].column_formula;

                            for (var k in fields)
                            {
                                var re = new RegExp("\\[" + k + "]", "g");

                                col_text = col_text.replace(re, fields[k]);

                                $('#row_' + key + "_" + setting.modulname + ' td:eq(' + counter + ')').text(col_text);
                            }
                        }
                        counter++;
                    }
                }
            },
            remove_row: function (key)
            {
                $('.row_' + key + "_" + setting.modulname).fadeOut('slow', function () {
                    $(this).remove();
                    thisgrid.urut_ulang_nomor();
                });
            },
            urut_ulang_nomor: function ()
            {
                $('.list_row' + setting.modulname).each(function (index) {
                    $('td:eq(0)', this).text(index + 1);
                });
            },
            markselected: function (selected_row)
            {
                $('#' + selected_row + ' td:eq(0)').append('<span title="sudah dipilih" class="ui-icon ui-icon-check"></span>').parent().addClass('marked');
            },
            unmarkselected: function (selected_row)
            {
                $('#' + selected_row + ' td:eq(0) span').remove();
                $('#' + selected_row).removeClass('marked');
            },
            update_jumlah_dipilih: function ()
            {
                var arrData = $("#data" + setting.modulname).data(), arr_id = [];

                for (var i in arrData)
                {
                    arr_id.push(arrData[i][setting.keycolumn.column]);
                }

                $('#jumlahdipilih' + setting.modulname).remove();
                if (arr_id.length > 0)
                {
                    $('form', '#tlist-pager' + setting.modulname).append('<span id="jumlahdipilih' + setting.modulname + '">&nbsp;&nbsp;|&nbsp;&nbsp;Jumlah Dipilih : ' + arr_id.length + '</span>');
                }
            },
            pilih: function (key)
            {
                //if ($('#row_'+key+'_'+setting.modulname).hasClass('marked') == false)
                if ($("#data" + setting.modulname).data(key))
                {
                    $('.pilih' + setting.modulname, '#row_' + key + '_' + setting.modulname).html('<span class="ui-icon ui-icon-check"></span> ' + setting.text_pilih);
                    this.unmarkselected('row_' + key + '_' + setting.modulname);
                    $("#data" + setting.modulname).removeData(key);
                    this.update_jumlah_dipilih();

                } else
                {
                    $('.pilih' + setting.modulname, '#row_' + key + '_' + setting.modulname).html('<span class="ui-icon ui-icon-cancel"></span> ' + setting.text_tidak_pilih);
                    this.markselected('row_' + key + '_' + setting.modulname);
                    eval('$("#data"+setting.modulname).data(key, {' + setting.keycolumn.column + ' : key})');
                    this.update_jumlah_dipilih();
                }
            }

        }


        //make accessible
        divgridcontainer.grid = thisgrid;
        thisgrid.apply_default_properties();
        divgridcontainer.setting = setting;

        thisgrid.init_buttons();
        thisgrid.init_grid();

        $('.tombol')
                .hover(function () {
                    $(this).addClass("ui-state-hover");
                }, function () {
                    $(this).removeClass("ui-state-hover");
                })
                .mousedown(function () {
                    $(this).addClass("ui-state-active");
                })
                .mouseup(function () {
                    $(this).removeClass("ui-state-active");
                });


        return divgridcontainer;
    };
})(jQuery);








