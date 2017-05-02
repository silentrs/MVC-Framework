<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 07.12.2016
 * Time: 13:08
 */

namespace core\classes;

use core\exception\ClassNotFoundException;
use core\interfaces\IHttp;

/**
 * Class HTTPFoundation
 * @package core\classes
 *
 * @method static IHttp createFromGet
 * @method static IHttp createFromPost
 */
class HTTPFoundation
{

    /**
     * HTTPFoundation constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param $name
     * @param $arguments
     * @return IHttp
     * @throws ClassNotFoundException
     */
    public static function __callStatic($name, $arguments)
    {
        preg_match('/^createFrom(.*)$/', $name, $out);
        array_shift($out);

        $class = sprintf('core\classes\http\Http%s', $out[0]);

        if (class_exists($class)) {
            return new $class();
        }

    }


}