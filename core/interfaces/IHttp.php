<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 07.12.2016
 * Time: 13:21
 */

namespace core\interfaces;


interface IHttp
{
    public function get($value, $filter = FILTER_DEFAULT);

    public function getArray($string, $filter = FILTER_VALIDATE_INT);
}