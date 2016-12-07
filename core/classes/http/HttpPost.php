<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 07.12.2016
 * Time: 13:34
 */

namespace core\classes\http;


use core\interfaces\IHttpRequest;

class HttpPost implements IHttpRequest
{

    public function get($value, $filter = FILTER_DEFAULT)
    {
        return filter_input(INPUT_POST, $value, $filter);
    }
}