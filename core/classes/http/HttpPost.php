<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 07.12.2016
 * Time: 13:34
 */

namespace core\classes\http;


use core\interfaces\IHttp;

class HttpPost implements IHttp
{

    public function get($value, $filter = FILTER_DEFAULT)
    {
        return filter_input(INPUT_POST, $value, $filter);
    }

    public function getArray($value, $filter = FILTER_VALIDATE_INT)
    {
        return filter_input_array(INPUT_POST,
            [
                $value => [
                    'filter' => $filter,
                    'flags' => FILTER_REQUIRE_ARRAY,
                    'options' => array('min_range' => 0),
                ]
            ]
        );
    }
}