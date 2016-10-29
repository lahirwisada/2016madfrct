<script type="text/javascript">

    var display_nama_diklat = function (raw_data, cell_data, final_data, key, nomor, row_data) {
        var status_pendaftaran = row_data.is_registration_closed == '0' ? "<span class=\"label label-success\">Buka</span>" : "<span class=\"label label-danger\">Tutup</span>";
        return row_data.nama_diklat + "; angkatan " + row_data.angkatan + "<br /><br />Status Pendaftaran : " + status_pendaftaran;
    };

    var display_tgl_pelaksanaan = function (raw_data, cell_data, final_data, key, nomor, row_data) {
        return row_data.tgl_pelaksanaan + " - " + row_data.tgl_selesai;
    };

    var detailDiklatfront_end_calender_diklat = function (ctext) {
        var urlDestination = base_url() + "front_end/fdaftar_diklat/detail/" + ctext;
        window.location.replace(urlDestination);
    };

    var calender_diklat = {
        config: {
            modulname: 'front_end_calender_diklat',
            formtitle: 'Kalender Diklat',
            container: 'divContainer',
            controller: 'api/adaftar_diklat',
            buttonlayout: 'vertical',
            rowperpage: '30',
            show_slcActive: false,
            aksi_width: '50px',
            url: base_url() + 'api/adaftar_diklat/load_kalender_diklat',
            params: {jnssprindik: 2},
            keycolumn: {column: 'id_diklat_crypted', type: 'txt'},
            advanced_header: true,
            header: [
                [
                    {name: "Nama Diklat", rowspan: 2, colspan: 1, field: "nama_diklat", sorting: false},
                    {name: "Pelaksanaan", rowspan: 2, colspan: 1, field: "tgl_pelaksanaan", sorting: false},
                    {name: "Penyelenggara", rowspan: 2, colspan: 1, field: "penyelenggara", sorting: false, width: '400px'},
                ]
            ],
            columns: [
                {
                    column: 'nama_diklat',
                    header: 'Nama Diklat',
                    display: true,
                    grid_column_width: '50px',
                    maxlength: '100',
                    show_me_as: display_nama_diklat,
                },
                {
                    column: 'tgl_pelaksanaan',
                    header: 'Pelaksanaan',
                    display: true,
                    grid_column_width: '50px',
                    maxlength: '100',
                    show_me_as: display_tgl_pelaksanaan,
                },
                {
                    column: 'penyelenggara',
                    header: 'Penyelenggara',
                    display: true,
                    grid_column_width: '100px',
                    maxlength: '100',
                }
            ],
            buttons: [
                {name: 'Detil', js: 'detailDiklat', "class": "detail", span: "fa fa-file-text-o", show: true, state: "active", parameter: "\"[key]\""}
            ],
            topbuttons: [
                {name: 'Refresh', id: 'btnRefresh', span: "ui-icon-refresh", show: true, access: "ALL", onclick: ''},
                {name: 'Cari', id: 'btnCari', span: "ui-icon-search", show: true, access: "ALL", onclick: ''}
            ]
        },
        grid_calender_diklat: null,
        init: function () {
            this._create_table();
        },
        _create_table: function () {
            calender_diklat.grid_calender_diklat = new LwsMasterForm(calender_diklat.config);

            calender_diklat.grid_calender_diklat.init_setting();
            calender_diklat.grid_calender_diklat.init_button();
            calender_diklat.grid_calender_diklat.init_grid();
        }
    };
</script>