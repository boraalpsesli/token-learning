<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function getAllArticles():LengthAwarePaginator
    {
        return Article::with('user')->paginate(10);
    }
    public function createArticle($user,array $data):Article
    {
        return $user->articles()->create($data);
    }
    public function getArticle(Article $article):Article
    {
        return $article->load('user');
    }
    public function updateArticle(Article $article,array $data):Article
    {
         $article->update($data);
         return $article;
    }
    public function deleteArticle(Article $article){
        $article->delete();
    }
}