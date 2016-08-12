<?php


/**
 * This function is a small helper like dd() but doesn't actually die.
 *
 * @param $var
 */
function d($var)
{
    array_map(function ($x) {
        (new \Illuminate\Support\Debug\Dumper())->dump($x);
    }, func_get_args());
}

/**
 * helper method, return file extension.
 *
 * @param $file
 *
 * @return bool|mixed
 */
function get_extension($file)
{
    $file_array = explode('.', $file);
    $extension = end($file_array);

    return $extension ? $extension : false;
}

/**
 * Helper function to flash messages to user.
 *
 * @param $message
 * @param $type
 */
function flash($message, $type)
{
    session()->flash('flash_message', [$message, $type]);
}

/**
 * This function will export the data into excel spread sheet.
 *
 * @param $data
 * @param null $others
 */
function export_to_excel($data, $name = null)
{
    // filename for download
    $filename = $name.'_'.date('Ymd').'.xls';

    // send header information
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Content-Type: application/vnd.ms-excel');

    $flag = false;
    foreach ($data as $row) {
        $record = $row['attributes'];
        if (!$flag) {
            // display field/column names as first row
            echo implode("\t", array_keys($record))."\r\n";
            $flag = true;
        }
        echo implode("\t", array_values($record))."\r\n";
    }

    return '';
}

//
//function cleanData(&$str)
//{
//    $str = preg_replace("/\t/", "\\t", $str);
//    $str = preg_replace("/\r?\n/", "\\n", $str);
//    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
//}

function can($permission)
{
    // WARNING: skip permissions check, for use in development mode ONLY
    if (env('SKIP_PERMISSION_CHECK')) {
        return true;
    }

    if (auth()->check()) {
        if (!auth()->user()->hasPermission($permission)) {
            abort(403, 'Access denied');
        }
    } else { // check if permission is given to anonymous users
        $role = \App\Models\User\RoleModel::whereName('anonymous')->first();
        if (!$role) { // anonymous role doesn't exist yet !
            abort(403, 'Access denied');
        } else {
            $permission = \App\Models\User\PermissionModel::whereName($permission)->first();
            // anonymous role doesn't have this permission sadly
            if (!$permission or !$role->permissions()->find([$permission->id])->count()) {
                abort(403, 'Access denied');
            }
        }
    }

    return true;
}

function file_upload($file_name, $file_upload_directory, array $file_allowed_extension)
{
    $uploaded_file = request()->file($file_name);

    if ($uploaded_file) { // if file has been uploaded

        $original_name = $uploaded_file->getClientOriginalName(); // get original file name

        $ext = get_extension($original_name); // check if extension is allowed or no check
        if (in_array($ext, $file_allowed_extension) or empty($file_allowed_extension)) {
            $new_file = $uploaded_file->getClientOriginalName();
            $result = $uploaded_file
                ->move(public_path().$file_upload_directory,
                    $new_file
                );

            return $new_file;
        } else { // unkown image extension
//            session()->flash('flash_message', 'unkown image file extension');
            return;
        }
    } // No file uploaded
    return 0;
}


function getSegmentFromEnd($instance, $position_from_end = 1)
{
    $segments = $instance->segments();

    return $segments[count($segments) - $position_from_end];
}
