<?php
declare(strict_types = 1);

require '../config.php';
require '../core/functions.php';
require '../core/autoload.php';

use core\classes\Route;


Route::get('/', 'MainController::index');

Route::start();