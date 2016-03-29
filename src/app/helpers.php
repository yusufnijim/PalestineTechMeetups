<?php


/**
 * helper method, return file extension.
 * @param $file
 * @return bool|mixed
 */
function get_extension($file)
{
    $file_array = explode(".", $file);
    $extension = end($file_array);

    return $extension ? $extension : false;
}
