<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 20.05.2017
 * Time: 11:59
 */

namespace core\classes\http;


use core\interfaces\IHttp;

class HttpCookie implements IHttp
{

    /** Method not supported in current class*/
    public function getArray($value, $filter = FILTER_VALIDATE_INT)
    {
        return $this->get($value);
    }

    public function get($value, $filter = FILTER_DEFAULT)
    {
        return filter_input(INPUT_COOKIE, $value, $filter);
    }
}