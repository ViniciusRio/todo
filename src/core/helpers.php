<?php
function view($view, $data = [])
{
    extract($data);

    return require_once DIR_BASE_NAME . "/app/views/{$view}.view.php";
}
