<<<<<<< HEAD
<?php

require '../config.php';
require '../core/functions.php';

// composer class autoload
require '../vendor/autoload.php';


use core\classes\Route;


Route::get('/', 'MainController::index');

Route::start();
====== =
<?
php
declare(strict_types=1);

require '../config.php';
require '../core/functions.php';

// composer class autoload
require '../vendor/autoload.php';

// framework class autoload
require '../core/autoload.php';


use core\classes\Route;


Route::get('/', 'MainController::index');

Route::start();
>>>>>>> parent of c0fbb3d... push
