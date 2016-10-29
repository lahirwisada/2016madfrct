<?php
/*
 * additional js page
 * @author lahirwisada@gmail.com
 */
if (isset($additional_js))
{
    if(is_array($additional_js))
    {
        foreach($additional_js as $js_additional)
        {
            echo load_partial($js_additional);
        }
    }
    else
        echo load_partial($additional_js);
}
?>