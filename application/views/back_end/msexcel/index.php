<?php

$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
$field_id = isset($field_id) ? $field_id : FALSE;
$paging_set = isset($paging_set) ? $paging_set : FALSE;


$active_modul = isset($active_modul) ? $active_modul : 'none';
$next_list_number = isset($next_list_number) ? $next_list_number : 1;

?>
<div style="margin-top:20px"></div>
<form action="<?php echo base_url();?>back_end/msexcel/upload/" method="post" enctype="multipart/form-data">
    <input type="file" name="file"/>
    <input type="submit" value="Upload file"/>
</form>