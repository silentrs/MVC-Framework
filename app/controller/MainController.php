<?php
/**
 * Created by PhpStorm.
 * User: smeex
 * Date: 14.11.2016
 * Time: 10:40
 */

namespace app\controller;


use app\Test;
use core\classes\BaseController;

class MainController extends BaseController
{
    public function index()
    {
        $model = new Test();
        $user = $model->getUserByName('admin');

        view('welcome', ['content' => print_r($user, true)]);
    }
}