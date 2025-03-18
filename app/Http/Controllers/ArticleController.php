<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\UserArticleCollection;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;
    protected $userService;
    public function __construct(ArticleService $articleService, UserService $userService)
    {
        $this->articleService = $articleService;
        $this->userService = $userService;
    }

    public function index()
    {
        $articles=$this->articleService->getAllArticles();
        return new ArticleCollection($articles);
        
    }
    public function indexUser(Request $request)
    {
        $articles=$this->userService->getUserArticles($request->user());
        return new UserArticleCollection($articles);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $article = $this->articleService->createArticle($request->user(),$validated);
        return new ArticleResource($article);
    }

    public function show(Article $article)
    {   $article=$this->articleService->getArticle($article);
        return new ArticleResource($article);
    }

    public function update(Request $request, Article $article)
    {
        $data=$request->only('title','content');
       $article=$this->articleService->updateArticle($article,$data);
        return new ArticleResource($article);
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);
        return response()->json(null, 204);
    }
}
