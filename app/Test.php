<?php

namespace app;

use core\classes\Model;

class Test extends Model
{
    protected static $table = 'users';

    public function getUserByName($name)
    {

        return $this->select('*')
            ->where(['username' => $name])
            ->fetch();

    }
}