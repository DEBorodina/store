<?php
function render($template = '',$vars = []){
    foreach ($vars as $varName => $varValue){
        ${$varName} = $varValue;
    }
    $path = __DIR__."/../views/".$template;
    if(file_exists($path) && is_file($path))
    {
        include $path;
    } else {
        echo "VIEW NOT FOUND";
    }
}