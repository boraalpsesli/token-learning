<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\UserArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles=Article::with('user')->paginate(10);
        return new ArticleCollection($articles);
        
    }
    public function indexUser(Request $request)
    {
        $articles = $request->user()->articles()->with('user')->paginate(10);
        return new UserArticleCollection($articles);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $article = $request->user()->articles()->create($validated);

        return new ArticleResource($article);
    }

    public function show(Article $article)
    {
        return new ArticleResource($article->load('user'));
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->only('title', 'content'));
        return new ArticleResource($article);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
