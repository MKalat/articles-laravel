<?php

namespace App\Http\Controllers;

use App\Models\Article as ModelsArticle;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Article extends Controller
{
    public function list(Request $req){
        $articles = ModelsArticle::all();
        return new JsonResponse(['result' => $articles],200);
    }

    public function get(Request $req){
        $article = ModelsArticle::find($req->id);
        return new JsonResponse(['result' => $article],200);
    }
    public function add(Request $req){
        $article = new ModelsArticle;
        $article->title = $req->title;
        $article->body = $req->body;
        $article->user = Auth::user();
        $article->save();
        return new JsonResponse(['result' => $article],200);
    }
    public function delete(Request $req){
        $article = ModelsArticle::find($req->id);
        $article->delete();
        return new JsonResponse(['result' => $req->id],200);
    }
    public function update(Request $req){
        $article = ModelsArticle::find($req->id);
        $article->update([
            'title' => $req->title,
            'body' => $req->body,
        ]);
        return new JsonResponse(['result' => $article],200);
    }
}
