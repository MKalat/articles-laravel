<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class UserIsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::user()){

            return response()->json(['message' => 'No Auth.'], 403);
        }

        $user = Auth::user();
        $articleId = $request->id;
        $userOfArticle = Article::find($articleId)->user;
        if ($user->id == $userOfArticle->id){
            return $next($request);
        }

        return response()->json(['message' => 'No Article.'], 404);
    }
}
