<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
$field_id = isset($field_id) ? $field_id : FALSE;
$paging_set = isset($paging_set) ? $paging_set : FALSE;
$active_modul = isset($active_modul) ? $active_modul : 'none';
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
$sort_url_query = isset($sort_url_query) ? $sort_url_query : "";
$sort_by = isset($sort_by) ? $sort_by : "";
$sort_mode = isset($sort_mode) ? $sort_mode : "";
?>
<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">                                
                <h3 class="panel-title"><?php echo $header_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="block">
                    <div id="dalam"></div>
                </div>
                <div class="block">
                    <div id="luar"></div>
                </div>
                <div class="block">
                    <div id="gabungan"></div>
                </div>
            </div>
        </div>
    </div>
</div>
