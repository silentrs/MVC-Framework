<?php

function csrf() : string
{
    return hash('md5', uniqid((time() ^ rand()) . "", true));
}

function view($viewName, array $replace = [])
{
    $file = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, ROOT . '/resources/view/' . $viewName);
    $ext = '.template.html';

    if (file_exists($file . $ext)) {
        $in = array_map(function ($key) {
            return '{' . strtoupper($key) . '}';
        }, array_keys($replace));

        echo str_replace($in, $replace, file_get_contents($file . $ext));
    } else {
        echo $file;
    }
}