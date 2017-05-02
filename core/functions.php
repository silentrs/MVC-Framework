<?php
use Philo\Blade\Blade;
/**
 * @return string
 */
function csrf()
{
    return hash('md5', uniqid((time() ^ rand()) . "Super secret string", true));
}

/**
 * @param $viewName
 * @param array $replace
 */
function view($viewName, array $replace = [])
{
    $views = ROOT . '/resources/view';
    $cache = ROOT . '/cache';

    $blade = new Blade($views, $cache);
    echo $blade->view()->make($viewName, $replace)->render();

}

/**
 * @param $section
 * @return mixed
 * @throws Exception
 */
function env($section)
{
    static $data;

    $file = ROOT . '/.env';

    if (file_exists($file)) {

        if (!isset($data)) {
            foreach (file($file) as $line) {
                $line = trim($line);
                if (substr($line, 0, 1) === '#' or strpos($line, '=') === false) continue;

                $pair = explode('=', $line);

                $data[trim($pair[0])] = trim($pair[1]);
            }
        }

    } else {
        throw new \Exception('Error, file .env not found or file is empty');
    }

    if (!array_key_exists($section, $data)) {
        throw new \Exception(sprintf('Error, section: "%s" not found', $section));
    }

    return $data[$section];
}



function location ($url, $code = 200) {
    ob_clean();
    http_response_code($code);
    header(sprintf('Location: %s', $url));
}