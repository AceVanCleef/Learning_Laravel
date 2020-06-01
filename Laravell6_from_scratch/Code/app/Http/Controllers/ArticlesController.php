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
}
