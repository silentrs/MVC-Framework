<?php
/**
 * Created by PhpStorm.
 * User: silent
 * Date: 2/17/17
 * Time: 7:17 PM
 */

namespace core\classes;

use core\interfaces\IStaticStorage;

class Session implements IStaticStorage
{

    public static function destroy()
    {
        session_destroy();
        setcookie('uid', hash('md5', '*(^)_(#@$&*)' . ')(#@*$^*)@(#'), time() + 3600, '/');
        setcookie('PHPSESSID', null, 0);
        self::init();
        $_SESSION = [];
    }

    public static function init()
    {
        session_start();
    }

    /**
     * @param $key
     * @return string|int|null
     */
    public static function read($key)
    {
        if (self::exists($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function exists($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * @param array $data
     */
    public static function writeArray(array $data)
    {
        foreach ($data as $key => $value) {
            self::write($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public static function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }
}