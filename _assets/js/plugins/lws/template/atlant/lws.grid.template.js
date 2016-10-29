/**
 * 
 * @type object class
 */
var lwsGridTemplate = {
    create_input_cari: function (setting) {
        var strHtmlCari = "";

        if (setting.carivisible)
        {
            strHtmlCari += '<div>';
        } else {
            strHtmlCari += '<div style="display: hidden;">';
        }

        strHtmlCari += '<div class="col-md-7">';
        strHtmlCari += '    <div class="input-group">';
        strHtmlCari += '        <input id="txtKeyword' + setting.modulname + '" class="form-control" placeholder="Silahkan masukkan kata kunci disini"/>';
        strHtmlCari += '        <div class="input-group-btn">';
        strHtmlCari += '            <a href="#" id="btnCariButton' + setting.modulname + '" class="btn btn-primary" onclick="return false;" >Go</a>';
        strHtmlCari += '        </div>';
        strHtmlCari += '    </div>';
        strHtmlCari += '</div>';
        if (setting.show_slcActive !== false) {
            strHtmlCari += '<div class="col-md-1">';
            strHtmlCari += '        <select id="slcActive' + setting.modulname + '" class="form-control ' + setting.show_slcActive + '">';
            strHtmlCari += '             <option value="all">All</option>';
            strHtmlCari += '             <option selected="selected" value="active">Active</option>';
            strHtmlCari += '             <option value="inactive">Inactive</option>';
            strHtmlCari += '        </select>';
            strHtmlCari += '</div></div>';
        }

        return strHtmlCari;
    },
    create_input_tombol: function (setting) {
        var strHtmlTombol = "";

        var IS_WRITE = false;
        if ($('#IS_WRITE').length > 0) {
            IS_WRITE = $('#IS_WRITE').val();
        }

        strHtmlTombol += '<div class="col-md-4">';
        strHtmlTombol += '<div class="btn-group">';
        for (var i in setting.topbuttons)
        {
            if ((((setting.topbuttons[i].access == "IS_WRITE") && (IS_WRITE == 'true')) || (setting.topbuttons[i].access == "ALL")) && (setting.topbuttons[i].show == true))
                var topbutton_onclick = "";
            if (typeof setting.topbuttons[i].onclick !== 'undefined' && setting.topbuttons[i].onclick != "") {
                topbutton_onclick = setting.topbuttons[i].onclick;
            }
            if ((setting.topbuttons[i].show == true)) {
                strHtmlTombol += "<a href='#' id='" + setting.topbuttons[i].id + setting.modulname + "' onclick='" + topbutton_onclick + "return false;' class='btn btn-success' >";
                strHtmlTombol += "<span class='fa " + setting.topbuttons[i].span + "'></span>" + setting.topbuttons[i].name;
                strHtmlTombol += "</a>";
            }
        }
        strHtmlTombol += '</div>';
        strHtmlTombol += '</div>';


        return strHtmlTombol;
    },
    create_buttons: function (setting) {
        var strhtml = '';
        if (typeof setting !== 'undefined') {

            var strHtmlCari = this.create_input_cari(setting);
            var strHtmlTombol = this.create_input_tombol(setting);

            strhtml += '<div class="block">' + strHtmlCari + strHtmlTombol + '</div><div class="block">&nbsp;</div>';
        }
        return strhtml;
    }, create_grid: function (setting) {
        var strhtml = '';
        if (typeof setting !== 'undefined') {
            strhtml += '<div class="block">';
            strhtml += '<div class="dataTables_wrapper no-footer">';
            strhtml += '<div class="table-responsive">';
            strhtml += '<table id="tlist' + setting.modulname + '" class="table no-footer" cellpadding="4" cellspacing="0">';
            strhtml += '    <thead id="tlist-head' + setting.modulname + '">';
            strhtml += '    </thead>';
            strhtml += '    <tbody id="tlist-body' + setting.modulname + '">';
            strhtml += '    </tbody>';
            strhtml += '</table>';
            strhtml += '</div>';
            strhtml += '</div>';
            strhtml += '</div>';

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

            return strhtml;
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