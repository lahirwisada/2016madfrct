<?php
$detail = isset($detail) ? $detail : FALSE;
?>

<div class="block">
    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
</div>

<div class="block">
    <div class="panel panel-default">
        <div class="panel-body">
            
            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Level</label>
                <div class="col-md-6 col-xs-12">
                    <select id="slc-level_persyaratan_diklat" class="form-control select">
                        <option value="1">level 1</option>
                        <option value="2">level 2</option>
                        <option value="3">level 3</option>
                    </select>
                    <span class="help-block">Untuk menentukan teks ini adalah sebuah sub teks atau bukan</span>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Persyaratan Untuk Mengikuti Diklat</label>
                <div class="col-md-6 col-xs-12">
                    <textarea id="txtarea-persyaratan_diklat" name="txtarea_persyaratan_diklat" class="form-control"></textarea>
                    <span class="help-block">Tulis teks tanpa penomoran.</span>
                </div>
            </div>

        </div>
        <div class="panel-footer">
            <button id="add-persyaratan_diklat" type="button" class="btn-default btn pull-right">Tambah</button>
        </div>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Persyaratan Untuk mengikuti Diklat</h3>         
            </div>
            <div id="daftar-persyaratan-diklat" class="panel-body">
                <table class="table no-footer" id="DataTables_Table_persyaratan_diklat" style="border-collapse:collapse;">
                    <thead>
                        <tr role="row">
                            <th>
                                Uraian
                            </th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>