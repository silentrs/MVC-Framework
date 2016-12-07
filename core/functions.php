<?php

function csrf() : string
{
    return hash('md5', uniqid((time() ^ rand()) . "", true));
}

/**
 * @param $viewName
 * @param array $replace
 */
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

/**
 * @param $section
 * @return mixed
 * @throws Exception
 */
function env($section) : string
{
    static $data;

    if (!isset($data) and file_exists(ROOT . '/.env')) {

        foreach (file(ROOT . '/.env') as $line) {
            $line = trim($line);
            if (substr($line, 0, 1) === '#' or strlen($line) < 3) continue;
            $pair = explode('=', $line);

            $data[trim($pair[0])] = trim($pair[1]);
        }
    }

    if (!array_key_exists($section, $data)) {
        throw new \Exception('Error, file .env not found or file is emty');
    }

    return $data[$section];
}
