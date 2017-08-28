<?php

require '../config.php';
require '../core/functions.php';

// composer class autoload
require '../vendor/autoload.php';



use core\classes\Route;


Route::get('/', 'MainController::index');

Route::start();
