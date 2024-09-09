<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article;
use App\Http\Middleware\UserIsAuthenticated;
use App\Http\Middleware\UserIsAuthor;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api/article/list', [Article::class, 'list']);
Route::get('/api/article/{id}', [Article::class, 'get']);
Route::post('/api/article/add/{id}', [Article::class, 'add'])->middleware(UserIsAuthenticated::class);
Route::post('/api/article/update/{id}', [Article::class, 'update'])->middleware([UserIsAuthenticated::class, UserIsAuthor::class]);
Route::post('/api/article/delete/{id}', [Article::class, 'delete'])->middleware([UserIsAuthenticated::class, UserIsAuthor::class]);;
