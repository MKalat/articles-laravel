<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleApi;
use App\Http\Middleware\UserIsAuthenticated;
use App\Http\Middleware\UserIsAuthor;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/article/list', [ArticleApi::class, 'list']);
Route::get('/article/{id}', [ArticleApi::class, 'get']);
Route::post('/article', [ArticleApi::class, 'add'])->middleware(UserIsAuthenticated::class);
Route::put('/article', [ArticleApi::class, 'update'])->middleware(UserIsAuthor::class);
Route::delete('/article', [ArticleApi::class, 'delete'])->middleware(UserIsAuthor::class);
