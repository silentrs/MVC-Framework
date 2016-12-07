<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 07.12.2016
 * Time: 13:08
 */

namespace core\classes;


use core\classes\http\ {
    HttpGet,
    HttpPost
};

class HTTPFoundation
{

    /**
     * HTTPFoundation constructor.
     */
    private function __construct()
    {
    }


    public static function createFromGet()
    {
        return new HttpGet();
    }

    public static function createFromPost()
    {
        return new HttpPost();
    }
}