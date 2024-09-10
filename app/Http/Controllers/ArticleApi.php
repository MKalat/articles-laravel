<?php

namespace App\Http\Controllers;

use App\Models\Articles as ModelsArticles;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Validator;

class ArticleApi extends Controller
{
    public function list(Request $req){
        $articles = ModelsArticles::all();
        return new JsonResponse(['result' => $articles],200);
    }

    public function get(Request $req){
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make(['id' => $req->route('id')], $rules);
        if ($validator->passes()) {
            $article = ModelsArticles::find($req->route('id'));
            return new JsonResponse(['result' => $article],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }
    public function add(Request $req){
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
            'publication_date' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->passes()) {
            $article = new ModelsArticles;
            $article->title = $req->input('title');
            $article->body = $req->input('body');
            $article->publication_date = $req->input('publication_date');
            $article->save();

            $user = Auth::user();
            $user->articles()->save($article);
            return new JsonResponse(['result' => $article],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }
    public function delete(Request $req){
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->passes()) {
            $article = ModelsArticles::find($req->input('id'));
            $article->delete();
            return new JsonResponse(['result' => ['id' => $req->input('id')]],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }
    public function update(Request $req){
        $rules = [
            'id' => 'required',
            'title' => 'required|max:255',
            'body' => 'required',
            'publication_date' => 'required',
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->passes()) {
            $article = ModelsArticles::find($req->input('id'));
            $article->update([
                'title' => $req->input('title'),
                'body' => $req->input('body'),
                'publication_date' => $req->input('publication_date'),
            ]);
            return new JsonResponse(['result' => $article],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }

    public function searchByTitle(Request $req){
        $article = ModelsArticles::where('title', 'like', '%'.$req->input('title').'%')->get();
        return new JsonResponse(['result' => $article],200);
    }

    public function searchByBody(Request $req){
        $article = ModelsArticles::where('body', 'like', '%'.$req->input('body').'%')->get();
        return new JsonResponse(['result' => $article],200);
    }
}
