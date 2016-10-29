
jQuery.ajaxSetup({
    statusCode: {
        401: function () {
            window.location = base_url() + "member/login?returnURL=" + base_url() + window.location.pathname;
        }
    }});


//Validate input
var r = {'special': /[\Wa-zA-Z]/g}
function valid(o, w)
{
    o.value = o.value.replace(r[w], '');
}

var t = {'specialchar': /[\~!@#$%^&*(){}:"?><'+=1234567890]/g}
function validspecial(o, w)
{
    o.value = o.value.replace(t[w], '');
}

function fixLength(o, max)
{
    var tempstr, tempint;
    if (o.value.length > max)
    {
        o.value = o.value.substring(0, max);
    }
}

//blinksatan tea
function doBlink(obj, start, finish) {
    jQuery(obj).fadeOut(300).fadeIn(300);
    if (start != finish) {
        start = start + 1;
        doBlink(obj, start, finish);
    }
}

function formatdecimal(sep, dec, obj)
{

    var split = obj.value.split(dec);
    var beforedec = split[0].replace(/[\Wa-zA-Z]/g, '');
    var afterdec = split[1];

    var counter = 0;
    var arrcounter = 0;
    var arr = new Array();
    var result = '';

    for (var i = beforedec.length - 1; i >= 0; i--)
    {
        counter++;

        if (counter == 3)
        {
            arr[arrcounter] = beforedec.substr(i, 3);
            counter = 0;
            arrcounter++;
        }

        if (i == 0)
        {
            if (beforedec.substr(i, counter).length > 0)
                arr[arrcounter] = beforedec.substr(i, counter);
        }
    }

    for (var i in arr)
    {
        if (i == 0)
            result = arr[i] + result;
        else
            result = arr[i] + sep + result;
    }

    if (split.length > 1)
    {
        afterdec = afterdec.replace(/[\Wa-zA-Z]/g, '');
        obj.value = result + dec + afterdec;
    } else
        obj.value = result;
}


function formatdecimal2(thousand, decimal, number) {

    var symbol = "";
    var places = 2;
    number = number || 0;
    places = !isNaN(places = Math.abs(places)) ? places : 2;
    symbol = symbol !== undefined ? symbol : "$";
    thousand = thousand || ",";
    decimal = decimal || ".";
    var negative = number < 0 ? "-" : "",
            i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
}

/*
 function formatdecimal2(sep, dec, value)
 {
 
 
 //convert int to string (trick);
 var nilai = value + "";
 
 var split = nilai.split(dec);
 var beforedec = split[0].replace(/[\Wa-zA-Z]/g,'');
 var afterdec = split[1];
 
 var counter = 0;
 var arrcounter = 0;
 var arr = new Array();
 var result = '';
 
 for (var i=nilai.length-1 ; i >=0 ; i--)
 {
 counter++;
 
 if (counter == 3)
 {
 arr[arrcounter] = nilai.substr(i,3);
 counter = 0;
 arrcounter++;
 }
 
 if (i == 0)
 {
 if (nilai.substr(i,counter).length > 0)
 arr[arrcounter] = nilai.substr(i,counter);
 }
 }
 
 for (var i in arr)
 {
 if (i == 0)
 result = arr[i] + result;
 else
 result = arr[i] + sep + result;
 }
 
 if (split.length > 1)
 {
 afterdec = afterdec.replace(/[\Wa-zA-Z]/g,'');
 value = result + dec + afterdec;
 }
 else
 {
 value = result;
 }
 
 return value;
 
 }*/



String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/g, "");
}
String.prototype.ltrim = function () {
    return this.replace(/^\s+/, "");
}
String.prototype.rtrim = function () {
    return this.replace(/\s+$/, "");
}

//next code from : http://www.breakingpar.com/bkp/home.nsf/0/CA99375CC06FB52687256AFB0013E5E9
function getSelectedCheckbox(buttonGroup) {
    // Go through all the check boxes. return an array of all the ones
    // that are selected (their position numbers). if no boxes were checked,
    // returned array will be empty (length will be zero)
    var retArr = new Array();
    var lastElement = 0;
    if (buttonGroup[0]) { // if the button group is an array (one check box is not an array)
        for (var i = 0; i < buttonGroup.length; i++) {
            if (buttonGroup[i].checked) {
                retArr.length = lastElement;
                retArr[lastElement] = i;
                lastElement++;
            }
        }
    } else { // There is only one check box (it's not an array)
        if (buttonGroup.checked) { // if the one check box is checked
            retArr.length = lastElement;
            retArr[lastElement] = 0; // return zero as the only array value
        }
    }
    return retArr;
} // Ends the "getSelectedCheckbox" function

function getSelectedCheckboxValue(buttonGroup) {
    // return an array of values selected in the check box group. if no boxes
    // were checked, returned array will be empty (length will be zero)
    var retArr = new Array(); // set up empty array for the return values
    var selectedItems = getSelectedCheckbox(buttonGroup);
    if (selectedItems.length != 0) { // if there was something selected
        retArr.length = selectedItems.length;
        for (var i = 0; i < selectedItems.length; i++) {
            if (buttonGroup[selectedItems[i]]) { // Make sure it's an array
                retArr[i] = buttonGroup[selectedItems[i]].value;
            } else { // It's not an array (there's just one check box and it's selected)
                retArr[i] = buttonGroup.value;// return that value
            }
        }
    }
    return retArr;
} // Ends the "getSelectedCheckBoxValue" function

//from http://www.w3schools.com/js/js_cookies.asp
function setCookie(c_name, value, exdays)
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name)
{
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++)
    {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name)
        {
            return unescape(y);
        }
    }
}

// Encode/decode htmlentities
function krEncodeEntities(s, quotes) {
    if (!quotes) {
        return $("<div/>").text(s).html();
    } else {
        return $("<div/>").text(s).html().replace(/"/g, '&quot;').replace(/'/, '&#039;');
    }
}
function krDencodeEntities(s) {
    return $("<div/>").html(s).text();
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function htmlDeEntities(str) {
    str = String(str).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
    alert(str);
    return str;
}

function postwith(to, p) {
    var myForm = document.createElement("form");
    myForm.method = "post";
    myForm.action = to;
    for (var k in p) {
        var myInput = document.createElement("input");
        myInput.setAttribute("name", k);
        myInput.setAttribute("value", p[k]);
        myForm.appendChild(myInput);
    }
    document.body.appendChild(myForm);
    myForm.submit();
    document.body.removeChild(myForm);
}


/**
 * Function : dump()
 * Arguments: The data - array,hash(associative array),object
 *    The level - OPTIONAL
 * Returns  : The textual representation of the array.
 * This function was inspired by the print_r function of PHP.
 * This will accept some data as the argument and return a
 * text that will be a more readable version of the
 * array/hash/object that is given.
 * Docs: http://www.openjs.com/scripts/others/dump_function_php_print_r.php
 */
function dump(arr, level) {
    var dumped_text = "";
    if (!level)
        level = 0;

    //The padding given at the beginning of the line.
    var level_padding = "";
    for (var j = 0; j < level + 1; j++)
        level_padding += "    ";

    if (typeof (arr) == 'object') { //Array/Hashes/Objects 
        for (var item in arr) {
            var value = arr[item];

            if (typeof (value) == 'object') { //If it is an array,
                dumped_text += level_padding + "'" + item + "' ...\n";
                dumped_text += dump(value, level + 1);
            } else {
                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }
    } else { //Stings/Chars/Numbers etc.
        dumped_text = "===>" + arr + "<===(" + typeof (arr) + ")";
    }
    return dumped_text;
}

function fillselect(select, url, item_field, value_field, value)
{
    if (url.trim() != '')
    {
        $.post(url, {},
                function (data) {

                    select.html('');
                    var strhtml = "<option value='0'>--- Pilih ---</option>";

                    for (var i in data)
                    {
                        strhtml += "<option value='" + data[i][value_field] + "'>" + data[i][item_field] + "</option>";
                    }

                    select.html(strhtml);

                }, "json").success(function () {

            if (value != null)
                select.val(value);

        });
    }
}

function checkauth()
{

}

function getValue(citem, data)
{
    for (var item in data)
    {
        myvalue = data[item];

        if (item == citem)
        {
            return myvalue;
        } else
        {
            if (typeof (myvalue) == 'object')
            {
                return getValue(citem, myvalue);
            }
        }


    }

    return '';
}


function CreateTableContentOrderDetail(data)
{
    var strhtml = '<br/><h2 class="" >Order Detail</h2>';

    for (var i in data)
    {
        strhtml += '<div style="width:600px;margin-bottom:20px;display:inline-block">';
        strhtml += '<div class="data" style=" float:left;width:200px"><img src="' + base_url() + 'store-product/' + data[i].store_id_user + '/' + data[i].id_store + '/' + data[i].id_product + '/' + data[i].product_name.toLowerCase().replace(/\ /g, "_") + '.jpg" width="200" /></div>';
        strhtml += '<div class="data" style=" float:right;width:300px">';
        strhtml += '	<p class="titlemain">' + data[i].product_name + '</p>';
        strhtml += '	<table width="100%" border="0" cellspacing="0" cellpadding="0">';
        strhtml += '		<tr>';
        strhtml += '			<td width="40%">Harga Satuan</td>';
        strhtml += '			<td width="1%">:</td>';
        strhtml += '			<td width="59%">Rp. ' + formatdecimal2('.', ',', data[i].unit_price) + '</td>';
        strhtml += '		</tr>';
        strhtml += '		<tr>';
        strhtml += '			<td>Jumlah</td>';
        strhtml += '			<td>:</td>';
        strhtml += '			<td>' + Number(data[i].quantity) + '</td>';
        strhtml += '		</tr>';
        strhtml += '		<tr>';
        strhtml += '			<td>Diskon</td>';
        strhtml += '			<td>:</td>';
        strhtml += '			<td>' + formatdecimal2('.', ',', data[i].discount) + '</td>';
        strhtml += '		</tr>';
        strhtml += '		<tr>';
        strhtml += '			<td>Sub Total</td>';
        strhtml += '			<td>:</td>';
        strhtml += '			<td>Rp. ' + formatdecimal2('.', ',', data[i].subtotal) + '</td>';
        strhtml += '		</tr>';
        strhtml += '		<tr>';
        strhtml += '			<td>Email Pembeli</td>';
        strhtml += '			<td>:</td>';
        strhtml += '			<td>' + data[i].buyer_email + '</td>';
        strhtml += '		</tr>';
        strhtml += '		<tr>';
        strhtml += '			<td>Nama Toko</td>';
        strhtml += '			<td>:</td>';
        strhtml += '			<td>' + data[i].store_name + '</td>';
        strhtml += '		</tr>';
        strhtml += '		<tr>';
        strhtml += '			<td>Email Toko</td>';
        strhtml += '			<td>:</td>';
        strhtml += '			<td>' + data[i].store_email + '</td>';
        strhtml += '		</tr>';
        strhtml += '	</table>';
        strhtml += '</div></div>';

    }

    //strhtml += '<span><a href="#" class="buttonright" onclick="$j(\'#divPurchaseOrder\').show(\'slow\');$j(\'#divPurchaseOrderDetil\').hide(\'slow\');">Kembali</a></span>';
    return strhtml;
}

function SumArray(someArray) {
    var total = 0;

    if (typeof someArray === 'undefined' && someArray.length > 0) {
        for (var i = 0; i < someArray.length; i++) {
            total += parseInt(someArray[i]);
        }
    }
    return total;
}

function toRp(a, b, c, d, e) {
    e = function (f) {
        return f.split('').reverse().join('')
    };
    b = e(parseInt(a, 10).toString());
    for (c = 0, d = ''; c < b.length; c++) {
        d += b[c];
        if ((c + 1) % 3 === 0 && c !== (b.length - 1)) {
            d += '.';
        }
    }
    return'Rp.\t' + e(d) + ',00'
}

function CreateTableContent(data, format, title)
{

    function format_column(citem, format)
    {
        var header = citem;
        for (var item in format)
        {
            var fcolumn = format[item]['column'];
            var fheader = format[item]['header'];
            var fformat = format[item]['format'];

            if (fcolumn == citem)
            {
                header = fheader;
                return header;
            }
        }

        return header;
    }

    function format_value(citem, cvalue, format)
    {

        var myvalue = cvalue;
        for (var item in format)
        {
            var fcolumn = format[item]['column'];
            var fformat = format[item]['format'];


            if (fcolumn == citem)
            {
                if (fformat == 'decimal')
                    myvalue = formatdecimal2('.', ',', cvalue);
                else if (fformat == 'rupiah')
                    myvalue = 'Rp. ' + formatdecimal2('.', ',', cvalue);
                else if (fformat == 'integer')
                    myvalue = Number(cvalue);
                return myvalue;
            }
        }

        return myvalue;
    }

    var html = '<h2 class="" >' + title + '</h2> <table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody>';
    for (var item in data) {
        if (item != 'rowcount')
        {
            var value = data[item];

            if (typeof (value) == 'object') { //If it is an array,
                //html += ' <tr><td width="14%">'+format_column(item,format)+'</td><td width="1%">:</td><td width="85%">'+CreateTableContent(value,format,item)+'</td> </tr>'; 
            } else {
                html += ' <tr><td width="14%">' + format_column(item, format) + '</td><td width="1%">:</td><td width="85%">' + format_value(item, value, format) + '</td> </tr>';
            }
        }
    }

    html += ' </tbody></table>';

    return html;
}

/**
 * 
 * @see http://stackoverflow.com/questions/5999998/how-can-i-check-if-a-javascript-variable-is-function-type
 * @param {type} functionToCheck
 * @returns {Boolean}
 */
function isFunction(functionToCheck) {
    var getType = {};
    return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
}

function isDefined(obj) {
    return typeof obj !== 'undefined';
}

function isArray(obj) {
    return (Object.prototype.toString.call(obj) === '[object Array]');
}

function isString(Obj) {
    return typeof Obj == 'string';
}

String.prototype.lwEscape = function () {
    return this.replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

var cleanValue = function (v) {
    if (typeof v !== 'undefined') {
        try {
            if (isString(v)) {
                return v.lwEscape();
            }
            return v;
        } catch (err) {
//            console.log(err);
//            console.log('the value is');
//            console.log(v);
            return v;
        }
    }
    return v;
}

var listHasValue = function (listClassName) {

    if (typeof listClassName !== 'undefined') {

        var count = 0;
        $("." + listClassName).each(function (index) {
            count++;
        });

        if (count > 0) {
            return true;
        }
    }
    return false;

};

var isObject = function (obj) {
    return (typeof obj === "object") && (obj !== null);
};

var isValidLahirWisadaSantoso = function (rowcellValid, rowcellErrorClass) {

    if (typeof rowcellValid == 'undefined' || typeof rowcellErrorClass == 'undefined') {
        return false;
    }

    if ($.isArray(rowcellValid)) {
        var valid = true;
        $.each(rowcellValid, function (indexRowcellValid, classRowCellValid) {
            valid = isValidLahirWisadaSantoso(classRowCellValid, rowcellErrorClass[indexRowcellValid]);
        });
        return valid;
    }

    var valid = true;
    if (!listHasValue(rowcellValid)) {
        $("." + rowcellErrorClass).show();
        valid = false;
    } else {
        $("." + rowcellErrorClass).hide();
    }
    return valid;
}

function objectToArray(Obj) {
    if (typeof Obj === '[object Object]') {
        return $.map(Obj, function (value, index) {
            return [value];
        });
    }

    return Obj;
}

function permute(input, permArr, usedChars) {
    var i, ch;
    for (i = 0; i < input.length; i++) {
        ch = input.splice(i, 1)[0];
        usedChars.push(ch);
        if (input.length == 0) {
            permArr.push(usedChars.slice());
        }
        permute(input, permArr, usedChars);
        input.splice(i, 0, ch);
        usedChars.pop();
    }
    return permArr;
}

function select2matcher(term, text) {

    if (term.length == 0)
        return true;
    texts = text.split(" ");

    allCombinations = permute(texts, [], []);

    for (i in allCombinations) {
        if (allCombinations[i].join(" ").toUpperCase().indexOf(term.toUpperCase()) == 0) {
            return true;
        }
    }

    return false;

}

function setCheck(id) {
    $("#" + id).attr("checked", "checked");
}

function remCheck(id) {
    $("#" + id).removeAttr("checked");
}

function isObjectAttributeExists(Obj, attributeName) {
    if (isDefined(Obj) && isDefined(attributeName) && isString(attributeName)) {
        return Obj.hasOwnProperty(attributeName);
    }
    return false;
}

$(document).ready(function () {
    $(".btn-hapus-row").click(function () {
        var url = $(this).attr('rel');

        modalConfirm({
            id: 'message-box-confirm',
            title: 'Mohon Perhatian',
            msg: 'Anda yakin akan menghapus berkas ini?',
            onOk: function () {
                window.location = url;
            }
        });
    });
});