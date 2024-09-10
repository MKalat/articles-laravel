<?php

#use App\Http\Controllers\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

# I'm not familiar with filament. so I leave empty stub. I have done also lots of full stack with vue.js, bootstrap, front-end etc with symfony, also with laravel,
# but not with Filament , so I decided to leave this point to not waste time on timed task
# MK


require __DIR__.'/auth.php';
