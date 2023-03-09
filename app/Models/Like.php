<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\News;
use App\Models\Comment;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    
    public function news()
    {
    	return $this->belongsTo(News::class);
	}
}
