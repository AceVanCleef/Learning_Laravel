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
}
