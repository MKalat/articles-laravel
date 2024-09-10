<?php

namespace App\Http\Controllers;

use App\Models\Article as ModelsArticle;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Validator;

class ArticleApi extends Controller
{
    public function list(Request $req){
        $articles = ModelsArticle::all();
        return new JsonResponse(['result' => $articles],200);
    }

    public function get(Request $req){
        $data = json_decode($req->payload, true);
        $rules = [
            'id' => 'required|unique:article',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $article = ModelsArticle::find($data['id']);
            return new JsonResponse(['result' => $article],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }
    public function add(Request $req){
        $data = json_decode($req->payload, true);

        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
            'publication_date' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $article = new ModelsArticle;
            $article->title = $data['title'];
            $article->body = $data['body'];
            $article->publication_date = $data['publication_date'];
            $article->user()->associate(Auth::user());
            $article->save();
            return new JsonResponse(['result' => $article],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }
    public function delete(Request $req){
        $data = json_decode($req->payload, true);

        $rules = [
            'id' => 'required|unique:article',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $article = ModelsArticle::find($data['id']);
            $article->delete();
            return new JsonResponse(['result' => $req->id],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }
    public function update(Request $req){
        $data = json_decode($req->payload, true);

        $rules = [
            'id' => 'required|unique:article',
            'title' => 'required|max:255',
            'body' => 'required',
            'publication_date' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $article = ModelsArticle::find($data['id']);
            $article->update([
                'title' => $data['titla'],
                'body' => $data['body'],
                'publication_date' => $data['publication_date'],
            ]);
            return new JsonResponse(['result' => $article],200);
        } else {
            return new JsonResponse(['message' => $validator->errors()->all()]);
        }
    }

    public function searchByTitle(Request $req){
        $article = ModelsArticle::where('title', 'like', '%'.$req->title.'%')->get();
        return new JsonResponse(['result' => $article],200);
    }

    public function searchByBody(Request $req){
        $article = ModelsArticle::where('body', 'like', '%'.$req->body.'%')->get();
        return new JsonResponse(['result' => $article],200);
    }
}
