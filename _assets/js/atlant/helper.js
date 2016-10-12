


function modalConfirm(config) {

    $("#whateverelement").empty();

    var _config = {
        id: 'message-box-confirm-for-something',
        type: 'message-box-info',
        title: 'Mohon Perhatian',
        titleIcon: 'fa fa-check-square-o',
        showButton: true,
        msg: 'Konfirmasi ..',
        onOk: function () {},
        onCancel: function () {}
    };

    if (typeof config === 'object' && config.constructor === {}.constructor) {
        $.extend(_config, config);
    }

    var divConfirmElement = '<div class="message-box ' + _config.type + ' animated fadeIn" id="' + _config.id + '">' +
            '<div class="mb-container">' +
            '<div class="mb-middle">' +
            '<div class="mb-title"><span class="' + _config.titleIcon + '"></span> ' + _config.title + '</div>' +
            '<div class="mb-content"><p>' + _config.msg + '</p></div>' +
            '<div class="mb-footer">';

    if (_config.showButton) {
        divConfirmElement += '<button id="btn-' + _config.id + '-cancel" class="btn btn-default btn-lg pull-right mb-control-close">Batal</button>&nbsp;&nbsp;' +
                '<button id="btn-' + _config.id + '-ok" style="margin-right: 5px;" class="btn btn-primary btn-lg pull-right mb-control-close"><span class="fa fa-thumbs-o-up"></span> Ok</button>';
    }
    divConfirmElement += '</div></div></div></div>';
    $("#whateverelement").append(divConfirmElement);

    $("#btn-" + _config.id + "-ok").click(function () {
        $(this).parents(".message-box").removeClass("open");
        _config.onOk();
        return false;
    });
    $("#btn-" + _config.id + "-cancel").click(function () {
        $(this).parents(".message-box").removeClass("open");
        _config.onCancel();
        return false;
    });

    var box = $("#" + _config.id);
    if (box.length > 0) {
        box.toggleClass("open");
        playAudio('alert');
    }

}


function modalAlert(config) {

    $("#whateverelement").empty();

    var _config = {
        id: 'message-box-alert-for-something',
        type: 'message-box-danger',
        title: 'Mohon Perhatian',
        titleIcon: 'fa fa-times',
        msg: 'Ditemukan kesalahan ..',
        onOk: function () {}
    };

    if (typeof config === 'object' && config.constructor === {}.constructor) {
        $.extend(_config, config);
    }

    var divConfirmElement = '<div class="message-box ' + _config.type + ' animated fadeIn" id="' + _config.id + '">' +
            '<div class="mb-container">' +
            '<div class="mb-middle">' +
            '<div class="mb-title"><span class="' + _config.titleIcon + '"></span> ' + _config.title + '</div>' +
            '<div class="mb-content"><p>' + _config.msg + '</p></div>' +
            '<div class="mb-footer">' +
            '<button id="btn-' + _config.id + '-ok" style="margin-right: 5px;" class="btn btn-default btn-lg pull-right mb-control-close"><span class="fa fa-thumbs-o-up"></span> Tutup</button>' +
            '</div></div></div></div>';

    $("#whateverelement").append(divConfirmElement);

    $("#btn-" + _config.id + "-ok").click(function () {
        $(this).parents(".message-box").removeClass("open");
        _config.onOk();
        return false;
    });

    var box = $("#" + _config.id);
    if (box.length > 0) {
        box.toggleClass("open");
        playAudio('fail');
    }

}