<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 20.05.2017
 * Time: 11:54
 */

namespace core\classes;


abstract class BaseController
{
    protected function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    protected function _get($key)
    {
        return HTTPFoundation::createFromGet()->get($key);
    }

    protected function _post($key)
    {
        return HTTPFoundation::createFromPost()->get($key);
    }

    protected function _cookie($key)
    {
        return HTTPFoundation::createFromCookie()->get($key);
    }
}