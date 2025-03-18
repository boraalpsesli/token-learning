<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function getUserArticles(User $user):LengthAwarePaginator{
        return $user->articles()->with('user')->paginate(10);
    }
}