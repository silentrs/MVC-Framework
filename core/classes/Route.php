<?php

namespace core\classes;


class Route
{


    private static $_routes = [];

    public static function get($url, $func)
    {
        self::request('get', $url, $func);
    }

    public static function post($url, $func)
    {
        self::request('post', $url, $func);
    }


    public static function start()
    {
        $url = self::getRequestURI();

        if (isset(self::$_routes[strtolower(self::getRequestMethod())])) {
            foreach (self::$_routes[strtolower(self::getRequestMethod())] as $regEx => $func) {
                if (preg_match('~^' . $regEx . '$~i', $url, $out)) {
                    array_shift($out); // delete full regex string

                    if (is_string($func)) {
                        self::callController($func, $out);
                    } else {
                        call_user_func_array($func, $out);
                    }

                    break;
                }
            }
        }
    }


    private static function request($method, $url, $func)
    {
        self::$_routes[$method][$url] = $func;
    }

    private static function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private static function callController($obj, $args = [])
    {
        $controller = self::getControllerPair($obj);

        if ($controller !== false) {
            $reflection = new \ReflectionClass('\\app\\controller\\' . $controller[0]);
            $instance = $reflection->newInstance();

            return call_user_func_array([$instance, $controller[1]], $args);
        }
    }

    private static function getControllerPair($str)
    {
        if (strpos($str, '::') !== false) {
            return explode('::', $str);
        }

        return false;
    }

    public static function getRequestURI()
    {
        $uri = $_SERVER['REQUEST_URI'];
        return substr($uri, 0, (!strpos($uri, '?')) ? strlen($uri) : strpos($uri, '?'));
    }

}