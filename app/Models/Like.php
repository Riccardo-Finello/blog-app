<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\News;
use App\Models\Comment;
use App\Models\User;

class Like extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'likes';
    
    public function news()
    {
    	return $this->belongsTo(News::class);
	}

    public function user()
    {
    	return $this->belongsTo(User::class);
	}
}
