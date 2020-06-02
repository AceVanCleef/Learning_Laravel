<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function show($id)
    {
        return view('/usingTemplate/articles/show', ['article' => Article::find($id)]);
    }

    //returns the view displaying all blog articles
    public function index()
    {
        return view('/usingTemplate/articles/index', ['articles' => Article::all()]);
    }
    
    public function create()
    {
        return view('/usingTemplate/articles/create');
    }

    public function store()
    {
        //validation


        //die("Posted :)");
        //persist the new article

        //..the long way
        $article = new Article();
        $article->title = request('title');
        $article->excert = request('excert');
        $article->body = request('body');

        $article->save(); //persists to DB

        return redirect('/usingTemplate/articles'); //redirects to given view.
    }
}
