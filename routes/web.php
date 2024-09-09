<?php

use App\Http\Controllers\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/article/list', [Article::class, 'list']);
Route::get('/article/{id}', [Article::class, 'get']);
Route::post('/article/add/{id}', [Article::class, 'add']);
Route::post('/article/update/{id}', [Article::class, 'update']);
Route::post('/article/delete/{id}', [Article::class, 'delete']);

require __DIR__.'/auth.php';
