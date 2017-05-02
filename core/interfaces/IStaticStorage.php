<?php
/**
 * Created by PhpStorm.
 * User: silent
 * Date: 2/19/17
 * Time: 9:58 PM
 */

namespace core\interfaces;


interface IStaticStorage
{
    /**
     * @param $key
     * @return string|int|null
     */
    public static function read($key);

    /**
     * @param $key
     * @param $value
     */
    public static function write($key, $value);

    /**
     * @param array $data
     */
    public static function writeArray(array $data);

    /**
     * @param $key
     * @return bool
     */
    public static function exists($key);

    /**
     * @param $key
     */
    public static function delete($key);
}