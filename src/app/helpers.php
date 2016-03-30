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


function flash($message, $type)
{
    session()->flash('flash_message', [$message, $type]);
}