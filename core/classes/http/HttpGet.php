<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 07.12.2016
 * Time: 13:22
 */

namespace core\classes\http;


use core\interfaces\IHttpRequest;

class HttpGet implements IHttpRequest
{

    public function get($value, $filter = FILTER_DEFAULT)
    {
        return filter_input(INPUT_GET, $value, $filter);
    }
}