

var LwsMasterForm = function (outsetting) {
    //Private

    var MySelf = this;

    var setting = {
        template: 'default',
        buttonlayout: 'horizontal',
        aksi_width: '280px',
        rowperpage: '10',
        show_aksi: true,
        modulname: '',
        formtitle: 'Form Data',
        keywordfilter: '',
        carivisible: false,
        controller: '',
        show_slcActive: '',
        show_nomor: true,
        columns: [],
        keycolumn: {column: '', type: 'txt'},
        dialogwidth: 600,
        container: "divContainer",
        url: '',
        params: {},
        buttons: [
            {name: 'pilih', js: 'Pilih', "class": "pilih", span: "fa-check", show: false, state: "active", parameter: "\"[key]\""},
            {name: 'ubah', js: 'Ubah', "class": "update", span: "fa-edit", show: true, state: "both", parameter: "\"[key]\""},
            {name: 'hapus', js: 'Hapus', "class": "delete", span: "fa-eraser", show: true, state: "active", parameter: "\"[key]\""},
            {name: 'kembalikan', js: 'Kembalikan', "class": "delete", span: "fa-undo", show: true, state: "inactive", parameter: "\"[key]\""}
        ],
        topbuttons: [
            {name: 'Tambah', id: 'btnNew', span: "fa-plus", show: true, access: "IS_WRITE", onclick: ''},
            {name: 'Refresh', id: 'btnRefresh', span: "fa-refresh", show: true, access: "ALL", onclick: ''},
            {name: 'Cari', id: 'btnCari', span: "fa-search", show: true, access: "ALL", onclick: ''}
        ],
        beforeloadgrid: function () {
        },
        beforeload: function () {/*alert('loaded');*/
        },
        afterload: function () {/*alert('loaded');*/
        },
        afternew: function () {/*alert('new');*/
        },
        after_pilih: function () {
        },
        after_simpan: function ()
        {
        },
    };

    function reload_header()
    {
        init_the_setting(setting);
        init_header(setting);

    }

    function show_me_as(raw_data, cell_data, final_data, key, nomor, row_data) {
        return final_data;
    }

    function init_the_setting(setting)
    {
        if (!grid_template_ready()) {
            return false;
        }

        for (var i in setting.columns)
        {
            if (setting.advanced_row)
            {
                for (var j in setting.columns[i])
                {
                    setting.columns[i][j] = $.extend(
                            {
                                sorting: true,
                                validation: '',
                                column: '',
                                header: '',
                                display_fields: true,
                                default_value: '',
                                display: true,
                                align: 'left',
                                showless: false,
                                showless_length: 45,
                                width: '100px',
                                autofill: true,
                                show_me_as: show_me_as,
                                grid_column_align: 'left',
                                grid_column_width: '150px'
                            }
                    , setting.columns[i][j]);
                }
            } else
            {
                setting.columns[i] = $.extend({
                    column: '',
                    header: '',
                    sorting: true,
                    display: true,
                    default_value: '',
                    group: false, //group
                    simpan: true,
                    display_fields: true,
                    single_data: true,
                    autofill: false,
                    column_formula: '',
                    type: 'txt',
                    align: 'left',
                    validation: '',
                    rows: '5',
                    showless: false,
                    showless_length: 45,
                    width: '100px',
                    grid_column_align: 'left',
                    grid_column_width: '150px',
                    maxlength: '',
                    minlength: '',
                    field_id: '',
                    field_kode: '',
                    field_nama: '',
                    place_value: '',
                    place_info: '',
                    url: '',
                    target: [],
                    placeholder: '',
                    show_me_as: show_me_as,
                    grid_helper_option: {}
                }, setting.columns[i]);
            }

        }

        for (var i in setting.header)
        {
            if (setting.advanced_header)
            {
                for (var j in setting.header[i])
                {
                    setting.header[i][j] = $.extend({
                        sorting: true,
                        field: ''

                    }, setting.header[i][j]);
                }
            }
        }
    }

    function reload_paging()
    {
        var extSetting = setting.beforeload(setting);

        if (typeof extSetting === 'object') {
            setting = $.extend(setting, extSetting);
        }

        var keyword = $('#txtKeyword' + setting.modulname).val(),
                isActive = $('#slcActive' + setting.modulname).val(),
                _url = '';

        if (setting.url == '')
            _url = base_url() + setting.controller + '/load_paging';
        else
            _url = setting.url;

        $('#tlist' + setting.modulname).Reload({
            url: _url, //base_url()+setting.controller+'/load_paging',//+setting.modulname,
            params: $.extend({'keyword': keyword, 'state_active': isActive}, setting.params)
        });

        setting.afterload();
    }

    function table_buttons(state, column)
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
                //strhtml += "$(\".row_[key]_"+ setting.modulname+"\").addClass(\"ui-state-active\");"; siti
                strhtml += " return false;' ><span class='ui-icon " + setting.buttons[i].span + "'></span>" + setting.buttons[i].name + "</a>" + strbuttonlayout;
            }
        }

        return strhtml;
    }

    function create_buttons()
    {
        var strhtml = lwsGridTemplate.create_buttons(setting);

        //$('#' + setting.container + setting.modulname).append(strhtml);
        $('#' + setting.container).append(strhtml);
    }

    function create_grid()
    {
        var strhtml = lwsGridTemplate.create_grid(setting);

        $('#' + setting.container).append(strhtml);
        $('#tlist-pager' + setting.modulname + ' form select').val(setting.rowperpage);
    }

    function create_form()
    {
        var strhtml = lwsGridTemplate.create_form(setting);

        //$('#' + setting.container + setting.modulname).append(strhtml);
        $('#' + setting.container).append(strhtml);
    }

    function init_header()
    {

        if (!grid_template_ready()) {
            return false;
        }

        if (!setting.advanced_header)
        {
            $('#tlist-head' + setting.modulname).html('');

            var strbody = '';

            if (setting.show_nomor) {
                strbody += '<tr class="ui-widget-header"><th style="text-align:center;">No</th>';
            }
            for (var i in setting.columns)
            {
                if (setting.columns[i].display)
                {
                    var text_header = setting.columns[i].header;

                    if (setting.columns[i].sorting)
                        text_header = '<a href="#" field="' + setting.columns[i].column + '" class="sorting' + setting.modulname + ' tombol " style="white-space:nowrap; color:white; font-weight:bold;" onclick="return false;" title="' + setting.columns[i].header + '" ><span class="fa fa-sort-asc"></span>' + setting.columns[i].header + '</a>';

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


                if (i == 0 && setting.show_nomor)
                    strbody += '<th style="text-align:center;" rowspan="' + setting.header.length + '" colspan="1" >No.</th>';

                for (var j in setting.header[i])
                {
                    var text_header = setting.header[i][j].name;

                    if (setting.header[i][j].sorting)
                        text_header = '<a href="#" field="' + setting.header[i][j].field + '" class="sorting' + setting.modulname + ' tombol " style="white-space:nowrap; font-weight:bold;" onclick="return false;" title="' + setting.header[i][j].name + '" ><span class="fa fa-sort"></span>' + setting.header[i][j].name + '</a>';


                    strbody += '<th style="text-align:center;" rowspan="' + setting.header[i][j].rowspan + '" colspan="' + setting.header[i][j].colspan + '" >' + text_header + '</th>';

                }

                if ((i == 0) && (setting.show_aksi)) {
                    strbody += '<th style="text-align:center;" rowspan="' + setting.header.length + '" colspan="1" >Aksi</th>';
                }

            }

            $('#tlist-head' + setting.modulname).html(strbody);

        }

        $('.sorting' + setting.modulname).click(function () {

            var sorting = [];

            if ($('span', this).hasClass('fa-sort'))
            {
                $(this).attr('title', $(this).text() + " " + "asc");
                $('span', this).removeClass('fa-sort').addClass('fa-sort-desc');
            } else if ($('span', this).hasClass('fa-sort-desc'))
            {
                $(this).attr('title', $(this).text() + " " + "desc");
                $('span', this).removeClass('fa-sort-desc').addClass('fa-sort-asc');

            } else if ($('span', this).hasClass('fa-sort-asc'))
            {
                $(this).attr('title', $(this).text());
                $('span', this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
            }

            $('a.sorting' + setting.modulname).each(function (index) {
                if ($('span', this).hasClass('fa-sort'))
                {
                    //do nothing
                } else if ($('span', this).hasClass('fa-sort-desc'))
                {
                    sorting.push({
                        sort_field: $(this).attr('field'),
                        sort_way: 'asc'
                    });

                } else if ($('span', this).hasClass('fa-sort-asc'))
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

            reload_paging();
        });
    }

    function init_form()
    {
        $('#Form' + setting.modulname + '-table').html('');

        var strbody = '';

        for (var i in setting.columns)
        {
            var star = '', maxlength = '', minlength = '', urlexample = '';
            if (setting.columns[i].maxlength != '')
                maxlength = 'maxlength=' + setting.columns[i].maxlength;
            if (setting.columns[i].minlength != '')
                minlength = 'minlength=' + setting.columns[i].minlength;
            if (setting.columns[i].validation.indexOf('required') > -1)
                star = '<span style="color:#CC0000">*</span>';
            if (setting.columns[i].validation.indexOf('url') > -1)
                urlexample = 'title="contoh:http://kpk.go.id"';
            strbody += '<tr valign="top">';
            strbody += '<td style="text-align:right;">' + setting.columns[i].header + star + '</td>';
            switch (setting.columns[i].type)
            {
                case 'search' :
                    strbody += '<td><input type="text" id="' + 'txt' + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '"  style="width:' + setting.columns[i].width + ';" class="' + setting.columns[i].validation + ' text ui-widget-content ui-corner-all" ' + maxlength + ' ' + minlength + ' ' + urlexample + '/></td>';
                    break;
                case 'txt' :
                    strbody += '<td><input placeholder="' + setting.columns[i].placeholder + '" type="text" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '"  style="width:' + setting.columns[i].width + ';" class="' + setting.columns[i].validation + ' text ui-widget-content ui-corner-all" ' + maxlength + ' ' + minlength + ' ' + urlexample + '/></td>';
                    break;
//                case 'chk' :strbody += '<td><input type="checkbox" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '" class="formchk" /><label for="' + setting.columns[i].type + setting.columns[i].column + '">' + setting.columns[i].header + '</label></td>';break;

                case 'txtarea' :
                    strbody += '<td><textarea id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '"  style="width:' + setting.columns[i].width + ';" class="' + setting.columns[i].validation + ' textarea ui-widget-content ui-corner-all" ' + maxlength + ' ' + minlength + ' rows="' + setting.columns[i].rows + '"></textarea></td>';
                    break;
                case 'chk' :
                    strbody += '<td><input type="checkbox" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" class="formchk" /></td>';
                    break;
                case 'auto' :
                    strbody += '<td><input type="hidden" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" class="formhidden ' + setting.columns[i].validation + '"/></td>';
                    break;
                case 'radio' :
                    strbody += '<td><div id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" ></div></td>';
                    break;
                case 'slc' :
                    strbody += '<td><select type="text" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '"  style="width:' + setting.columns[i].width + ';" class="' + setting.columns[i].validation + ' select ui-widget-content ui-corner-all"></select></td>';
                    break;
                case 'tgl' :
                    strbody += '<td><input type="text" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" name="' + setting.columns[i].type + setting.columns[i].column + '"  style="width:' + setting.columns[i].width + ';" class="' + setting.columns[i].validation + ' text ui-widget-content ui-corner-all tanggalan" ' + maxlength + ' ' + minlength + ' title="dd/mm/yyyy" /></td>';
                    break;
                case 'hidden' :
                    strbody += '<td><input type="hidden" id="' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '" class="formhidden ' + setting.columns[i].validation + '"/></td>';
                    break;
            }
            strbody += '</tr>';
        }

        $('#Form' + setting.modulname + '-table').html(strbody);

        $('.formhidden').each(function (index) {
            $(this).parent().parent().hide();
        });
        //$('.formchk').button();

        //init tanggalan
        $(".tanggalan").datepicker($.datepicker.regional[ "id" ]);
//        $(".tanggalan").datepicker("option", {changeMonth: true, changeYear: true, showOn: 'button', dateFormat: 'dd/mm/yy', buttonText: '...', buttonImage: GetImagePath()+'calendar.gif', buttonImageOnly: true});
        // edit siti
        $(".tanggalan").datepicker("option", {changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy'});

        //init selection control
        for (var i in setting.columns)
        {
            if (setting.columns[i].type == 'slc')
            {
                initselect($('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname), setting.columns[i].url, setting.columns[i].item_field, setting.columns[i].value_field, setting.columns[i].default_value);
            } else if (setting.columns[i].type == 'auto')
            {

                /**
                 * @todo replace dengan select2
                 * @see untuk style bootstrap lihat di http://select2.github.io/select2-bootstrap-theme/4.0.3.html
                 */
                //init autosuggestion      
                $('#txt' + setting.columns[i].textbox + '_' + setting.modulname).indraautosuggestion({
                    url: base_url() + setting.columns[i].url,
                    place_id: $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname),
                    place_value: $('#txt' + setting.columns[i].place_value + '_' + setting.modulname),
                    place_info: $('#txt' + setting.columns[i].place_info + '_' + setting.modulname),
                    field_id: setting.columns[i].field_id,
                    field_kode: setting.columns[i].field_kode,
                    field_nama: setting.columns[i].field_nama,
                    autofill: setting.columns[i].autofill
                });

            } else if (setting.columns[i].type == 'radio')
            {
                initradio($('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname), setting.columns[i].url, setting.columns[i].item_field, setting.columns[i].value_field, setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname);
            } else if (setting.columns[i].type == 'search')
            {
                $('#' + 'txt' + setting.columns[i].column + '_' + setting.modulname).lwspicker({
                    judul: "pilih",
                    target: setting.columns[i].target,
                    grid_helper_option: setting.columns[i].grid_helper_option
                });
            }
        }
    }

    function initselect(select, url, item_field, value_field, value)
    {
        if (url.trim() != '')
        {
            $.post(url, {}, function (data) {

                select.html('');
                select.attr('default_val', value);

                var strhtml = "<option value=''>--- Pilih ---</option>";

                for (var i in data)
                {
                    strhtml += '<option value="' + data[i][value_field] + '">' + data[i][item_field] + '</option>';
                }

                select.html(strhtml);

                select.val(value);

            }, "json");
        }
    }

    function initradio(div, url, item_field, value_field, name)
    {
        if (url.trim() != '')
        {
            $.post(url, {},
                    function (data) {

                        div.html('');
                        var strhtml = "";

                        for (var i in data)
                        {
                            strhtml += '<input type="radio" name="' + name + '" value="' + data[i][value_field] + '" text="' + data[i][item_field] + '" >' + data[i][item_field] + '<br/>';
                        }

                        div.html(strhtml);

                    }, "json");
        }
    }

    function resetform()
    {
        $('#State' + setting.modulname).val('new');
        $('#key' + setting.modulname).val('');
        $('#Form' + setting.modulname + '-table input[type="text"]').val('');
        $('#Form' + setting.modulname + '-table select').each(function () {
            $(this).val($(this).attr('default_val'));
        });
        $('#Form' + setting.modulname + '-table textarea').val('');
    }

    function baru()
    {
        var IS_WRITE = $('#IS_WRITE').val();
        if (IS_WRITE == 'true') {
            $('#Form' + setting.modulname + '-form input').attr('disabled', false);
            $('#Form' + setting.modulname + '-form textarea').attr('disabled', false);
            $('#Form' + setting.modulname + '-form select').attr('disabled', false);
        }
        ;

        resetform();
        $('.btn').show();
        $('#form' + setting.modulname + '-load').hide();
        $('#Form' + setting.modulname).dialog('open');

        setting.afternew();
    }


    function simpandata()
    {
        if ($("#Form" + setting.modulname + "-form").valid() == true)
        {
            var IS_UPDATE = $('#IS_UPDATE').val();
            var fields = [], form_fields = new Object(),
                    State_Modul = $('#State' + setting.modulname).val(),
                    key = $('#key' + setting.modulname).val();

            //fill form_fields for client manipulation, untuk update row setelah simpan
            form_fields.state = State_Modul;
            //eval("form_fields."+setting.keycolumn.column+"='"+key+"'");

            for (var i in setting.columns)
            {
                if (setting.columns[i].simpan == true)
                {
                    var value = $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).val();

                    if (setting.columns[i].type == 'txtarea')
                    {
                        value = value.replace(/\"/g, "'").replace(/\n/g, '<br>');
                    }

                    if (setting.columns[i].type == 'radio')
                    {
                        value = $('input[type=radio][name=' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + ']:checked').attr('text');
                    }

                    eval("form_fields." + setting.columns[i].column + "='" + value + "'");

                    if (setting.columns[i].type == 'slc')
                    {
                        value = $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + ' option:selected').text();
                        eval("form_fields." + setting.columns[i].item_field + "='" + value + "'");
                    }

                }
            }

            //fill fields for database
            for (var i in setting.columns)
            {
                if (setting.columns[i].simpan == true)
                {
                    var val = $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).val();
                    if (setting.columns[i].type == 'radio')
                    {
                        val = $('input[type=radio][name=' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + ']:checked').attr('value');
                    }

                    if (setting.columns[i].type == 'txtarea')
                    {
                        val = val.replace(/\"/g, "'").replace(/\n/g, '<br>');
                    }

                    if ((setting.columns[i].type == 'auto') && (val == ''))
                    {
                        val = '0';
                    }

                    if (setting.columns[i].type == 'chk')
                    {
                        if ($('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).attr('checked'))//.attr('value');
                        {
                            val = 1
                        } else
                        {
                            val = 0;
                        }
                    }

                    //var obj= {'column' : setting.columns[i].column, 'value' : $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).val()};
                    var obj = {'column': setting.columns[i].column, 'value': val};
                    fields.push(obj);
                }
            }

            $('.btn').hide();
            $('#form' + setting.modulname + '-load').show();

            if (State_Modul == 'new')
            {

                ///$.post(setting.controller+"/insert"+ setting.modulname, {'fields' : fields},
                $.post(base_url() + setting.controller + "/insert", {'fields': fields},
                        function (data) {
                            alert(data.result);

                            if (data.id != '0')
                            {
                                resetform();

                                if (setting.modulname.trim() == '')
                                {
                                    reload_paging();
                                } else
                                {
                                    reload_paging();
                                    $('#Form' + setting.modulname).dialog('close');
                                }

                            }

                            $('.btn').show();
                            $('#form' + setting.modulname + '-load').hide();

                            eval("form_fields." + setting.keycolumn.column + "='" + data.id + "'");
                            after_simpan(form_fields);

                        }, "json");

            } else
            {
                //$.post(setting.controller+"/update"+ setting.modulname, {'fields' : fields, 'key' : key},
                $.post(base_url() + setting.controller + "/update", {'fields': fields, 'key': key},
                        function (data) {

                            alert(data.result);

                            //if (setting.modulname.trim() == '')
                            //{                      
                            var counter = 1;
                            for (var i in setting.columns)
                            {
                                if (setting.columns[i].display)
                                {
//                                    $('#row_'+ key + "_" + setting.modulname + ' td:eq(' + counter + ')').text(data.data[setting.columns[i].column]);
                                    if (setting.columns[i].single_data)
                                    {

                                        if (setting.columns[i].type == 'txtarea')
                                        {
                                            $('#row_' + key + "_" + setting.modulname + ' td:eq(' + counter + ')').text(data.data[setting.columns[i].column].replace(/\<br>/g, '\n'));
                                        } else
                                        {
                                            $('#row_' + key + "_" + setting.modulname + ' td:eq(' + counter + ')').text(data.data[setting.columns[i].column]);
                                        }

                                    } else
                                    {
                                        var col_text = setting.columns[i].column_formula;

                                        for (var k in data.data)
                                        {
                                            var re = new RegExp("\\[" + k + "]", "g");



                                            if (setting.columns[i].type == 'txtarea')
                                            {
                                                col_text = col_text.replace(re, data.data[k].replace(/\<br>/g, '\n'));

                                            } else
                                            {
                                                col_text = col_text.replace(re, data.data[k]);
                                            }

                                            $('#row_' + key + "_" + setting.modulname + ' td:eq(' + counter + ')').html(col_text.replace(/<br>/g, "\n"));
                                        }
                                    }
                                    counter++;
                                }
                            }

                            if (IS_UPDATE == 'false') {
                                $('input.update').attr('disabled', true).remove();
                            } else
                                $('.update').show();
                            //}

                            $('#Form' + setting.modulname).dialog('close');


                            $('.btn').show();
                            $('#form' + setting.modulname + '-load').hide();

                            eval("form_fields." + setting.keycolumn.column + "='" + key + "'");
                            after_simpan(data.data);

                        }, "json");
            }

        }
    }

    function markselected(selected_row)
    {
        $('#' + selected_row + ' td:eq(0)').append('<span title="sudah dipilih" class="ui-icon ui-icon-check"></span>').parent().addClass('marked');
    }

    function unmarkselected(selected_row)
    {
        $('#' + selected_row + ' td:eq(0) span').remove();
        $('#' + selected_row).removeClass('marked');
    }

    function update_jumlah_dipilih()
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
    }

    function resetPilih() {

        $('.list_row' + setting.modulname).each(function (index) {
            var key_value = $(this).attr(setting.keycolumn.column);

            if ($("#data" + setting.modulname).data(key_value))
            {
                $('.pilih' + setting.modulname, '#row_' + key_value + '_' + setting.modulname)
                        .html('<span class="ui-icon ui-icon-check"></span> pilih');

                unmarkselected('row_' + key_value + '_' + setting.modulname);
                $("#data" + setting.modulname).removeData(key_value);
                update_jumlah_dipilih();
            }

        });
    }

    function Pilih(key)
    {
        //if ($('#row_'+key+'_'+setting.modulname).hasClass('marked') == false)


        /**
         * Jika belum dipilih maka masuk ke else
         * Jika sudah dipilih maka masuk ke if
         */
        var isRemoveData = false;
        if ($("#data" + setting.modulname).data(key))
        {
            $('.pilih' + setting.modulname, '#row_' + key + '_' + setting.modulname)
                    .html('<span class="ui-icon ui-icon-check"></span> pilih');
            unmarkselected('row_' + key + '_' + setting.modulname);
            $("#data" + setting.modulname).removeData(key);
            update_jumlah_dipilih();
            isRemoveData = true;
        } else
        {
            $('.pilih' + setting.modulname, '#row_' + key + '_' + setting.modulname)
                    .html('<span class="ui-icon ui-icon-cancel"></span> tidak pilih');
            markselected('row_' + key + '_' + setting.modulname);
            eval('$("#data"+setting.modulname).data(key, {' + setting.keycolumn.column + ' : key})');
            update_jumlah_dipilih();
        }
        setting.after_pilih(key, isRemoveData);
    }

    function urut_ulang_nomor()
    {
        $('.list_row' + setting.modulname).each(function (index) {
            $('td:eq(0)', this).text(index + 1);
        });
    }

    function after_ubah_load(key)
    {
        MySelf.after_ubah_load(key);
    }

    function after_ubah_load_fields(data)
    {
        MySelf.after_ubah_load_fields(data);
    }

    function after_simpan(fields)
    {
        MySelf.after_simpan(fields);
    }

    function ubahdata(key)
    {
        var IS_UPDATE = $('#IS_UPDATE').val();
        if (IS_UPDATE == 'false') {
            $('#Form' + setting.modulname + '-form input').attr('disabled', true);
            $('#Form' + setting.modulname + '-form textarea').attr('disabled', true);
            $('#Form' + setting.modulname + '-form select').attr('disabled', true);
        }
        ;


        $('.list_row' + setting.modulname).removeClass("ui-state-active");
        $('#row_' + key + "_" + setting.modulname).addClass("ui-state-active");

        resetform();

        $('#State' + setting.modulname).val('change');
        $('#key' + setting.modulname).val(key);
        $('.btn').hide();
        $('#form' + setting.modulname + '-load').show();

        $('#Form' + setting.modulname).dialog('open');

        //$.post(setting.controller+"/getbykey"+ setting.modulname, {'key' : key},
        $.post(base_url() + setting.controller + "/getbykey", {'key': key},
                function (data) {

                    for (var i in setting.columns)
                    {
                        if (setting.columns[i].type == 'search')
                        {
                            $('#' + 'txt' + setting.columns[i].column + '_' + setting.modulname).val(data[setting.columns[i].column]);
                        }

                        if (setting.columns[i].type == 'radio')
                        {
                            $('input[type=radio][name=' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname + '][value=' + data[setting.columns[i].column] + ']').attr('checked', true);
                        } else if (setting.columns[i].type == 'chk')
                        {
                            if (data[setting.columns[i].column] == '1')
                                $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).attr('checked', true);
                        } else
                        {
                            if (setting.columns[i].type == 'txtarea')
                            {
                                $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).val(data[setting.columns[i].column].replace(/\<br>/g, '\n'));
                            } else
                                $('#' + setting.columns[i].type + setting.columns[i].column + '_' + setting.modulname).val(data[setting.columns[i].column]);
                        }
                    }


                    $('#' + setting.keycolumn.type + setting.keycolumn.column).attr("disabled", true);

                    $('.btn').show();
                    $('#form' + setting.modulname + '-load').hide();

                    after_ubah_load(key);

                    after_ubah_load_fields(data);

                }, "json");

    }

    //Public

    LwsMasterForm.prototype.after_simpan = function (fields) {

        //alert(key);
    };

    LwsMasterForm.prototype.after_ubah_load = function (key) {

        //alert(key);
    };

    LwsMasterForm.prototype.onclose_form = function () {

        //alert(key);
    };

    LwsMasterForm.prototype.onopen_form = function () {

        //alert(key);
    };

    LwsMasterForm.prototype.extendSetting = function () {

    };

    function grid_template_ready() {
        if (typeof lwsGridTemplate === 'undefined') {
            console.log("lws.master.form grid template (lws.grid.template.js) tidak ditemukan.");
            return false;
        }
        return true;
    }
    ;

    this.init_setting = function (p) {

        if (!grid_template_ready()) {
            return false;
        }

        setting = $.extend(setting, outsetting);

        if (typeof p === 'object') {
            setting = $.extend(setting, p);
        }
        init_the_setting(setting);
    };

    this.init_button = function () {

        if (!grid_template_ready()) {
            return false;
        }

        create_buttons();

        $('#btnNew' + setting.modulname).click(function () {
            baru();
        });

        $("#btnRefresh" + setting.modulname).click(function () {
            reload_paging();
        });

//        $("#btnCari"+setting.modulname).click(function(){
        $("#divSearch" + setting.modulname).animate({"height": "toggle"}, {duration: 500});
        $("#txtKeyword" + setting.modulname).val('');
//	});

        $('#btnCariButton' + setting.modulname).click(function () {
            reload_paging();
        });

        $("#txtKeyword" + setting.modulname).keypress(function (e) {
            if (e.which == 13) {
                reload_paging();
                return false;
            }
        });

        $("#txtKeyword" + setting.modulname).keyup(function (e) {
            reload_paging();
        });

    };

    this.init_grid = function () {

        if (!grid_template_ready()) {
            return false;
        }

        create_grid();
        init_header();

        var _url = '';

        var extSetting = setting.beforeloadgrid(setting);

        if (typeof extSetting === 'object') {
            setting = $.extend(setting, extSetting);
        }

        if (setting.url == '') {
            _url = base_url() + setting.controller + '/load_paging';
        } else {
            _url = setting.url;
        }

        $('#tlist' + setting.modulname).lwspager({
            url: _url, //base_url()+setting.controller+'/load_paging',//+setting.modulname,
            loaddata: this.load_paging,
            params: $.extend({'keyword': '', 'state_active': 'active'}, setting.params),
            pagerloader: $("#tlist-load" + setting.modulname),
            pagercontainer: $("#tlist-pager" + setting.modulname)
        });
    };

    this.init_form = function () {

        if (!grid_template_ready()) {
            return false;
        }

        var IS_WRITE = $('#IS_WRITE').val(), IS_UPDATE = $('#IS_UPDATE').val();
        create_form();
        init_form();

        $("#Form" + setting.modulname).dialog({
            bgiframe: true,
            autoOpen: false,
            height: 'auto',
            resizable: false,
            width: setting.dialogwidth,
            modal: true,
            buttons: [
                {
                    id: "btnSimpan" + setting.modulname,
                    'class': "btn" + setting.modulname,
                    text: "Simpan",
                    click: function () {
                        simpandata();
                    },
                    disabled: ((IS_WRITE == 'true') || (IS_UPDATE == 'true')) ? false : true
                },
                {
                    id: "btnKembali" + setting.modulname,
                    'class': "btn" + setting.modulname,
                    text: "Kembali",
                    click: function () {
                        $(this).dialog("close");
                    },
                    disabled: false
                },
                {
                    id: "btnReset" + setting.modulname,
                    'class': "btn" + setting.modulname,
                    text: "Set Ulang",
                    click: function () {
                        var key = $('#key' + setting.modulname).val();

                        if (confirm('Data akan diset ulang, Apakah anda yakin?'))
                        {
                            if ((key == 0) || (key == ''))
                            {
                                resetform();
                                $('#' + setting.keycolumn.type + setting.keycolumn.column).focus();
                            } else
                            {
                                ubahdata(key);
                            }
                        }

                    },
                    disabled: false
                }
            ],
            close: function () {
                MySelf.onclose_form();
            },
            open: function () {
                MySelf.onopen_form();
            }
        });

        jQuery.validator.addMethod(
                "selectNone",
                function (value, element) {
                    if (element.value == "")
                    {
                        return false;
                    } else
                        return true;
                },
                "Please Choose One."
                );

        $("#Form" + setting.modulname + "-form").validate();
    };

    this.test = function () {
        alert('Yes you did it!');
    };

    this.get_setting = function (attr) { // function to reload control

        var temp;
        temp = eval('setting.params' + attr);

        return temp;
    };

    this.reload_paging = function (p)
    {
        $.extend(setting, p);
        reload_paging();
    };

    this.reload_header = function (p)
    {
        $.extend(setting, p);
        reload_header();
    };

    this.load_paging = function (mydata)
    {
        var data = mydata.result;
        var IS_UPDATE = $('#IS_UPDATE').val(), IS_DELETE = $('#IS_DELETE').val();

        $('#tlist-body' + setting.modulname).html('');

        var strbody = '';

        var id_group_now = '', group_count = 1, group_field = '';//group


        for (var i in data)
        {
            var nomor = (parseInt(i) + (parseInt(mydata.currentpage) * parseInt(mydata.rowperpage))) - parseInt(mydata.rowperpage) + 1,
                    tbuttons = "", my_fields = "", raw_data = "";
            var key = data[i][setting.keycolumn.column];

            strbody += "<tr id='row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname + "' class='list_row" + setting.modulname + " row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname + "' " + setting.keycolumn.column + "='" + data[i][setting.keycolumn.column] + "'>";
            var key_nomor = "row_nomor_" + setting.modulname;
            data[i][key_nomor] = nomor;
            if (setting.show_nomor)
                strbody += "<td style='text-align:center; vertical-align:top; width:20px;'>" + nomor + "</td>";
            //grid column
            for (var j in setting.columns)
            {
                tbuttons = table_buttons("active", setting.columns[j].column).replace(/\[key]/g, key);
//                    my_fields = (setting.columns[j].display_fields) ? data[i][setting.columns[j].column] : "";
                raw_data = (setting.columns[j].display_fields) ? data[i][setting.columns[j].column] : "";
                if (setting.columns[j].single_data)
                {
                    my_fields = raw_data;
                } else
                {
                    my_fields = setting.columns[j].column_formula;

                    for (var k in data[i])
                    {
                        var re = new RegExp("\\[" + k + "]", "g");

                        my_fields = (setting.columns[j].display_fields) ? my_fields.replace(re, data[i][k]) : "";
                    }
                }

//                    for ( var k in setting.columns )
//                    {
//                        var re = new RegExp("\\[" + setting.columns[k].column + "]", "g");
//                        tbuttons = tbuttons.replace(re,data[i][setting.columns[k].column]);
//                    }

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
                    var group_class = '', cellContent = my_fields + tbuttons, tempUniqueId = Math.round(new Date().getTime() / 1000) + Math.floor(Math.random()) + parseInt(i), addID = setting.columns[j].column;

                    if (setting.columns[j].group)
                        group_class = 'group_' + data[i][setting.groupcolumn.column];

                    //list_rowLaporanDugaanKasusEloList row_7_LaporanDugaanKasusEloList
                    //gridShowMoreCellOnClick

                    //console.log(setting.columns[j].column, tempUniqueId);
                    if (setting.columns[j].showless) {
                        var arrCellContent = cellContent.split(" ");
                        if (arrCellContent.length > setting.columns[j].showless_length) {
                            cellContent = "<div class=\"lws-cell-more-content\"><div id=\"less_content_" + tempUniqueId + "_" + addID + "\" class=\"less_content_" + tempUniqueId + "_" + addID + " lws-show-more\" style=\"\">" + cellContent + "</div><div id=\"show-less-div-" + tempUniqueId + "_" + addID + "\" class=\"lws-cell-show-more\" style=\"cursor: pointer;\" onclick=\"masterGridShowMoreCell.onClick(" + tempUniqueId + "," + "'" + addID + "'" + ");\"><span style=\"color:#CC0000\">More...</span></div></div>";
                        }
                        arrCellContent = new Array();
                    }

                    cellContent = setting.columns[j].show_me_as(raw_data, my_fields, cellContent, key, nomor, data[i]);

                    strbody += "<td style='text-align:" + setting.columns[j].grid_column_align + "; vertical-align:top; width:" + setting.columns[j].grid_column_width + ";' class='" + group_class + "'>" + cellContent + "</td>";

                    /**
                     * @deprecated by lahir ganteng
                     var group_class = '';
                     
                     if (setting.columns[j].group)
                     group_class = 'group_' + data[i][setting.keycolumn.column];
                     
                     strbody += "<td style='text-align:" + setting.columns[j].grid_column_align + "; vertical-align:top; width:" + setting.columns[j].grid_column_width + ";' class='" + group_class + "'>" + my_fields + tbuttons + "</td>";
                     */
                }
            }

            $('.group_' + id_group_now).attr('rowspan', group_count);//group //for last row group
            //end grid column

            if (data[i].record_active == "1")
            {
                tbuttons = table_buttons("active", "").replace(/\[key]/g, key);
            } else
            {
                tbuttons = table_buttons("inactive", "").replace(/\[key]/g, key);
            }

//                for ( var k in setting.columns )
//                {
//                    var re = new RegExp("\\[" + setting.columns[k].column + "]", "g");
//                    tbuttons = tbuttons.replace(re,data[i][setting.columns[k].column]);
//                }

            for (var k in data[i])
            {
                var re = new RegExp("\\[" + k + "]", "g");
                tbuttons = tbuttons.replace(re, data[i][k]);
            }

            if (setting.show_aksi) {
                strbody += "<td style='text-align:left; width:" + setting.aksi_width + ";'>" + tbuttons + "</td>";
            }
            
            strbody += "</tr>";

            $('#tlist-body' + setting.modulname).append(strbody);
            strbody = "";

            $("#row_" + data[i][setting.keycolumn.column] + "_" + setting.modulname).data('data', data[i]);
        }

        //$('#tlist-body'+setting.modulname).html(strbody);

        if (IS_UPDATE == 'false') {
            $('.update').show();
            $('a.update').text('lihat').append("<span class='ui-icon ui-icon-zoomin'></span>");
            $('input.update').attr('disabled', true);
        } else
            $('.update').show();
        if (IS_DELETE == 'false')
            $('.delete').remove();
        else
            $('.delete').show();

        $('.list_row' + setting.modulname).hover(function () {
            $(this).addClass("ui-state-highlight");
        }, function () {
            $(this).removeClass("ui-state-highlight");
        });

        $('#tlist' + setting.modulname).show();
        $('#tlist-load' + setting.modulname).hide();

        $('.list_row' + setting.modulname).each(function (index) {
            var key_value = $(this).attr(setting.keycolumn.column);

            if ($("#data" + setting.modulname).data(key_value))
            {
                $('.pilih' + setting.modulname, '#row_' + key_value + '_' + setting.modulname).html('<span class="ui-icon ui-icon-cancel"></span> tidak pilih');
                markselected('row_' + key_value + '_' + setting.modulname);
            }

        });

        update_jumlah_dipilih();

        setting.afterload();
    };

    this.Pilih = function (key) {
        Pilih(key);

    };

    this.ubah = function (key) {
        ubahdata(key);
    };

    this.hapus = function (key) {
        if (confirm('Hapus data, Anda Yakin ?'))
        {
            var isActive = $('#slcActive' + setting.modulname).val();
            //$.post(setting.controller + "/delete" + setting.modulname, {'key' : key},
            $.post(base_url() + setting.controller + "/delete", {'key': key},
                    function (data) {
                        alert(data.result);
                        if (data.status == 'Berhasil')
                            if (isActive != 'all') {
                                $('#row_' + key + "_" + setting.modulname).fadeOut('slow', function () {
                                    $(this).remove();
                                    urut_ulang_nomor();
                                });
                            }
                        reload_paging();
                    }, "json");
        }
    };

    this.hapus2 = function (key, column) {
        if (confirm('Hapus data, Anda Yakin ?'))
        {
            var isActive = $('#slcActive' + setting.modulname).val();
            //$.post(setting.controller + "/delete" + setting.modulname, {'key' : key},
            $.post(base_url() + setting.controller + "/delete", {'key': key, 'keycolumn': column, 'general': true},
                    function (data) {
                        alert(data.result);
                        if (data.status == 'Berhasil')
                            if (isActive != 'all') {
                                $('#row_' + key + "_" + setting.modulname).fadeOut('slow', function () {
                                    $(this).remove();
                                    urut_ulang_nomor();
                                });
                            }
                        reload_paging();
                    }, "json");
        }
    };

    this.kembalikan = function (key) {
        if (confirm('Kembalikan data, Anda Yakin ?'))
        {
            var isActive = $('#slcActive' + setting.modulname).val();
            //$.post(setting.controller + "/undelete" + setting.modulname, {'key' : key},
            $.post(base_url() + setting.controller + "/undelete", {'key': key},
                    function (data) {
                        alert(data.result);
                        if (data.status == 'Berhasil')
                            if (isActive != 'all')
                                $('#row_' + key + "_" + setting.modulname).fadeOut('slow', function () {
                                    $(this).remove();
                                    urut_ulang_nomor();
                                });
                            else
                                reload_paging();
                    }, "json");
        }
    };

    // g3n1k pakai ini jika tidak ingin buat function undelete
    this.kembalikan2 = function (key, column) {
        if (confirm('Kembalikan data, Anda Yakin ?'))
        {
            var isActive = $('#slcActive' + setting.modulname).val();
            //$.post(setting.controller + "/undelete" + setting.modulname, {'key' : key},
            $.post(base_url() + setting.controller + "/undelete", {'key': key, 'keycolumn': column, 'general': true},
                    function (data) {
                        alert(data.result);
                        if (data.status == 'Berhasil')
                            if (isActive != 'all')
                                $('#row_' + key + "_" + setting.modulname).fadeOut('slow', function () {
                                    $(this).remove();
                                    urut_ulang_nomor();
                                });
                            else
                                reload_paging();
                    }, "json");
        }
    };
}


