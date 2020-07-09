<?php

function h($var){
    return htmlspecialchars($var);
}

function d($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function dd($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}

function redirect($url)
{
    header("Location: ".$url);
}


?>
