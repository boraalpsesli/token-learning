<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens,Notifiable;

    protected $fillable=[
        'name',
        'email',
        'password'
    ];
    protected $hidden=[
        'password',
        'remember_token'
    ];
    public $timestamps = false;
    
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    
}
