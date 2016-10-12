// JavaScript Document
(function ($) {
    var docpicker = false;

    $(document).ready(function () {
        docpicker = true;
    });

    $.fn.lwspicker = function (setting) {

        return this.each(function () {
            if (!docpicker)
            {
                //$(this).hide();
                var inputcontainer = this;
                $(document).ready(function () {
                    $.Initialize_picker(inputcontainer, setting);
                });
            } else {
                $.Initialize_picker(this, setting);
            }
        });

    };

    $.fn.reload_lwspicker = function (p) {
        return this.each(function () {

            this.setting = $.extend(this.setting, p);

            $.Initialize_picker(this, this.setting);

        });
    }

    $.fn.close_dialog = function (p) {
        return this.each(function () {

            this.picker.close_dialog();

        });
    }


    $.fn.PickerOptions = function (p) { //function to update general options

        return this.each(function () {
            $.extend(this.setting, p);
        });

    }; //end Options

    $.Initialize_picker = function (inputcontainer, setting)
    {
        // apply default properties
        setting = $.extend(true, {
            nama: $(inputcontainer).attr('id'),
            target: [],
            height: '430',
            width: '650',
            judul: 'pilih data',
            grid_helper_option: {
                buttons: [
                    {name: 'pilih', js: 'Pilih', "class": "pilih", span: "ui-icon-check", show: true, state: "active", parameter: "\"[key]\""}
                ]
            },
            after_pilih: function (data) {},
            after_load: function () {}
        }, setting);

        var mylwspicker = {
            init_button_cari: function () {
                //inisiasi tombol                
                $(inputcontainer).after('<button name="btn' + setting.nama + '">cari</button>');

                $('button[name=btn' + setting.nama + ']').button({
                    icons: {
                        primary: "ui-icon-search"
                    },
                    text: false
                });


                $('button[name=btn' + setting.nama + ']').click(function () {
                    $('div[name=div' + setting.nama + ']').dialog('open');
                    return false;
                });
            },
            init_dialog: function () {
                $('button[name=btn' + setting.nama + ']').after('<style>table#tlist' + setting.grid_helper_option.modulname + ' { margin: 1em 0; border-collapse: collapse; width: 620px; }table#tlist' + setting.grid_helper_option.modulname + ' td, table#tlistListNomorAgenda th { border: 1px solid #ddd; padding: .6em 10px; text-align: left; }</style>');
                $('button[name=btn' + setting.nama + ']').after('<div name="div' + setting.nama + '" style="display:none" title="' + setting.judul + '"><div id="grid' + setting.nama + '"></div>');

                $('div[name=div' + setting.nama + ']').dialog({
                    bgiframe: true,
                    autoOpen: false,
                    height: setting.height,
                    width: setting.width,
                    resizable: false,
                    modal: false,
                    close: function () {
                        //allFields.val('').removeClass('ui-state-error');
                    },
                    open: function () {

                        //resetpilihanagendaterkait(); 
                        //CariAgendaTerkait.reload_paging();
                    },
                    buttons: {
                        Kembali: function () {
                            $(this).dialog('close');
                        }
                    }
                });
            },
            init_lws_grid: function () {
                $('#grid' + setting.nama + '').lwsgrid($.extend(setting.grid_helper_option, {afterload: function () {
                        $('.pilih' + setting.grid_helper_option.modulname).each(function (index) {
                            $(this).attr("onclick", "return false;");
                        });
                    }}));


                var grid_helper_target = typeof setting.grid_helper_option.target !== 'undefined' ? setting.grid_helper_option.target : setting.target;

                $('.pilih' + setting.grid_helper_option.modulname).live('click', function () {
                    var data = $(this).parent().parent().data('data');

                    for (var i in grid_helper_target)
                    {
                        var value = eval('data.' + grid_helper_target[i].field);
                        var regex = /(<([^>]+)>)/ig;

                        value = value.replace(regex, "");

                        $("#" + grid_helper_target[i].target).val(value);
                    }

                    $('div[name=div' + setting.nama + ']').dialog('close');

                    setting.after_pilih(data);
                });


                $('#tlist-pager' + setting.grid_helper_option.modulname + ' select.pagesize').val(5);
                $('#grid' + setting.nama + '').reload_grid();
            },
            close_dialog: function () {
                $('div[name=div' + setting.nama + ']').dialog('close');
            }
        };
        //make accessible
        inputcontainer.picker = mylwspicker;
        inputcontainer.setting = setting;

        mylwspicker.init_button_cari();
        mylwspicker.init_dialog();
        mylwspicker.init_lws_grid();

        setting.after_load();

        return inputcontainer;

    };


})(jQuery);





