
/**
 * @requires JQuery, workbook/shim.js, workbook/jszip.js, workbook/cpexcel.js, workbook/xlsx.core.min.js, workbook/ods.js
 * @requires text
 * @type type
 */

var _setting = {
    /**
     * setting.cell_map = [
     *      {col_name: "nomor", x_cell: "A"},
     *      dst,
     * ];
     * tidak boleh kosong
     */
    cells_map: [],
    tableId: "",
    start_row: 2, //asumsi bahwa row pertama adalah nama kolom
    _workbook: null, //nama workbook
    rows_found: 0,
    show_in_table: false,
    inputFileFormName: 'file'
};


function lws_excelreader(setting) {

    if (typeof XLSX !== 'undefined') {
        this.setting = _setting;
        $.extend(this.setting, setting);

        this.records = [];

        if ($("#" + this.setting.inputFileFormName).length > 0) {
            var elem_inputBB = document.getElementById(this.setting.inputFileFormName), self = this;
            if (elem_inputBB.addEventListener)
                elem_inputBB.addEventListener('change', function(e){_read_file(e, self);}, false);
        } else {
            alert("maaf, nama input form file tidak ditemukan.");
        }
    } else {
        alert("Sistem pembaca Excel belum tersedia.");
    }
}

var _read_file = function (e, self) {
    
    var files = e.target.files;

    self.__reset();

    if (files.length > 0 && typeof XLSX !== 'undefined') {
        var file = files[0];
        {
            var reader = new FileReader();
//                var name = file.name;

            reader.onload = function (e) {
                var data = e.target.result;

                self.setting._workbook = XLSX.read(data, {type: 'binary'});
                self.parse_workbook();
            };

            reader.readAsBinaryString(file);
        }
    }
};

lws_excelreader.prototype.constructor = lws_excelreader;

lws_excelreader.prototype.__reset = function () {
    this.setting._workbook = null;
    this.records = [];
    this.setting.row_found = 0;
};
lws_excelreader.prototype.__get_max_row = function (refSheet) {
    if (refSheet != '') {
        var cellStartEnd = refSheet.split(':'), cell_used = {first_cell: {x: null, y: null}, last_cell: {x: null, y: null}, };
        if (isArray(cellStartEnd) && cellStartEnd.length == 2) {
            /** find first Y and last X */
            fy = cellStartEnd[0].match(/\d+/g);
            fx = cellStartEnd[0].match(/\D+/g);

            if (fy.length > 0 && fx.length > 0) {
                cell_used.first_cell.x = fx[0];
                cell_used.first_cell.y = fy[0];
            }

            /** find last Y and last X */
            ly = cellStartEnd[1].match(/\d+/g);
            lx = cellStartEnd[1].match(/\D+/g);

            if (ly.length > 0 && lx.length > 0) {
                cell_used.last_cell.x = lx[0];
                cell_used.last_cell.y = ly[0];
            }

            return cell_used;

        }
    }
    return null;
};
lws_excelreader.prototype.__add_to_table = function (row_cols) {
    var tr = $("<tr></tr>");
    var dataRow = {};
    for (var i in row_cols) {
        var td = $("<td></td>");
        td.text(row_cols[i].value);
        dataRow[row_cols[i].col_name] = row_cols[i].value;
        tr.append(td);
        td = undefined;
    }
    tr.data(dataRow);
    $("#" + this.setting.tableId + " > tbody:last").append(tr);
    tr = undefined;
};
lws_excelreader.prototype.__collect_data_sheet = function (sheet_data) {
    if (typeof sheet_data === 'undefined') {
        return false;
    }

    var cell_used = this.__get_max_row(sheet_data['!ref']), i = 1, cellname = null;
//            console.log(sheet_data);return false;

    for (i = this.setting.start_row; i <= cell_used.last_cell.y; i++) {
        var col_in_row = [];
        for (var j in this.setting.cells_map) {
            var target_cell = this.setting.cells_map[j];
            cellname = target_cell.x_cell + i;
            var ObjValue = sheet_data[cellname], value = '-';
            if (isObjectAttributeExists(ObjValue, 'v')) {
                value = ObjValue['v'];
            }
//                    console.log(value);
            col_in_row.push({col_name: target_cell.col_name, value: value});
        }
        this.records.push(col_in_row);
        if (this.setting.show_in_table) {
            this.__add_to_table(col_in_row);
        }
    }

};
lws_excelreader.prototype.parse_workbook = function () {
    var wb = this.setting._workbook;
    if (wb != null && isObjectAttributeExists(wb, 'SheetNames') && isObjectAttributeExists(wb, 'Sheets')) {
        var sheetName = wb.SheetNames[0], sheetData = wb.Sheets[sheetName];

        if (!(isObject(sheetData) && isObjectAttributeExists(sheetData, '!ref'))) {
            return false;
        }

        this.__collect_data_sheet(sheetData);
    }
};
lws_excelreader.prototype.collectData = function () {
    if (this.records.length > 0) {
        return this.records;
    }
    return null;
};