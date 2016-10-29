/**
 * 
 * @type object class
 */
var lwsGridTemplate = {
    create_buttons: function (setting) {
        var strhtml = '';
        if (typeof setting !== 'undefined') {

            var IS_WRITE = true;
            if ($('#IS_WRITE').length > 0) {
                IS_WRITE = $('#IS_WRITE').val();
            }

            strhtml += '<p>&nbsp;</p>';
//        
            for (var i in setting.topbuttons)
            {
                if ((((setting.topbuttons[i].access == "IS_WRITE") && (IS_WRITE == 'true')) || (setting.topbuttons[i].access == "ALL")) && (setting.topbuttons[i].show == true))
                    var topbutton_onclick = "";
                if (typeof setting.topbuttons[i].onclick !== 'undefined' && setting.topbuttons[i].onclick != "") {
                    topbutton_onclick = setting.topbuttons[i].onclick;
                }
                if ((setting.topbuttons[i].show == true)) {
                    strhtml += "<a href='#' style='float:left; margin: 5px;' id='" + setting.topbuttons[i].id + setting.modulname + "' class='tombol ui-state-default ui-corner-all' onclick='" + topbutton_onclick + "return false;' ><span class='ui-icon " + setting.topbuttons[i].span + "'></span>" + setting.topbuttons[i].name + "</a>&nbsp;&nbsp;";
                }
            }

            //strhtml += '<p>&nbsp;</p>';
            strhtml += '<div style="float:left;" id="divSearch' + setting.modulname;

            if (setting.carivisible)
            {
                strhtml += '" class="">';
            } else
            {
                strhtml += '" class="hidden">';
            }

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
        return strhtml;
    }, create_grid: function (setting) {
        var strhtml = '';
        if (typeof setting !== 'undefined') {
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
            strhtml += '            <option value="5">5</option>';
            strhtml += '            <option selected="selected"  value="10">10</option>';
            strhtml += '            <option value="20">20</option>';
            strhtml += '            <option value="30">30</option>';
            strhtml += '            <option value="40">40</option>';
            strhtml += '            <option value="50">50</option>';
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

            $('#tlist-pager' + setting.modulname + ' form select').val(setting.rowperpage);
        }
        return strhtml;
    }, create_form: function (setting) {
        var strhtml = '';
        if (typeof setting !== 'undefined') {
            strhtml += '<div id="Form' + setting.modulname + '" title="' + setting.formtitle + '" >';
            strhtml += '     <form id="Form' + setting.modulname + '-form" method="get" action="">';
            strhtml += '        <fieldset>';
            strhtml += '            <table id="Form' + setting.modulname + '-table">';
            strhtml += '            </table>';
            strhtml += '         </fieldset>';
            strhtml += '     </form>';
            strhtml += '<input id="State' + setting.modulname + '" type="hidden"/>';
            strhtml += '<input id="key' + setting.modulname + '" type="hidden"/>';
            strhtml += '    <p>&nbsp;</p>';
            strhtml += '    <p id="form' + setting.modulname + '-load" class="hidden"><img alt="please wait..." src="' + GetImagePath() + '/bar-loader.gif" />loading...</p>';
            strhtml += '</div>';
        }
        return strhtml;
    }
};