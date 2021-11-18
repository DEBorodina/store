<?php
function render($template = ''){

    $path = __DIR__."/../views/".$template;
    if(file_exists($path) && is_file($path))
    {
        include $path;
    } else {
        echo "VIEW NOT FOUND";
    }
}