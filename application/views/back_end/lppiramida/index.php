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
//var_dump($records);
?>
<div class="row">
    <div class="col-md-12">

        <?php if ($records['max_gabungan'] > 0) : ?>
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Dalam & Luar Struktur</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Dalam Struktur</a></li>
                    <li><a href="#tab-third" role="tab" data-toggle="tab">Luar Struktur</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div id="gabungan"></div>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <div id="dalam"></div>
                    </div>
                    <div class="tab-pane" id="tab-third">
                        <div id="luar"></div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">                                
                    <h3 class="panel-title"><?php echo $header_title; ?></h3>
                </div>
                <div class="panel-body">
                    Belum ada data...
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="clearfix"></div>