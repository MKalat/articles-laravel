<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleApi;
use App\Http\Middleware\UserIsAuthenticated;
use App\Http\Middleware\UserIsAuthor;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api/article/list', [ArticleApi::class, 'list']);
Route::get('/api/article/{id}', [ArticleApi::class, 'get']);
Route::post('/api/article/add/{id}', [ArticleApi::class, 'add'])->middleware(UserIsAuthenticated::class);
Route::put('/api/article/update/{id}', [ArticleApi::class, 'update'])->middleware(UserIsAuthor::class);
Route::delete('/api/article/delete/{id}', [ArticleApi::class, 'delete'])->middleware(UserIsAuthor::class);;
