<?php

namespace app\controller;

use app\Test as Model;

class TestController
{

    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $this->model = new Model();
    }

    public function index($id)
    {
        echo $id;
    }
}