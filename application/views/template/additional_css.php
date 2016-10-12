<?php
/*
 * additional css page
 * @author lahirwisada@gmail.com
 */
if (isset($additional_css))
{
    if(is_array($additional_css))
    {
        foreach($additional_css as $css_additional)
        {
            echo load_partial($css_additional);
        }
    }
    else
        echo load_partial($additional_css);
}
?>