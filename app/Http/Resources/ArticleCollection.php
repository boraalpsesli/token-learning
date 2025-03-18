<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => true,
            'message' => 'Articles retrieved successfully',
            'data' => $this->collection->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'content' => $article->content,
                    'created_at' => $article->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $article->updated_at->format('Y-m-d H:i:s'),
                    'author' => [
                        'id' => $article->user->id,
                        'name' => $article->user->name,
                        'email' => $article->user->email,
                    ],
                ];
            }),
            'meta' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
            ],
        ];
    }
}
