<?php

use app\controller\IndexController;
use Webman\Route;


Route::get('/', [IndexController::class, 'index']);
