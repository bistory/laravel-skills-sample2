<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'news_id'];

    /**
     * Get the news that owns the comment.
     */
    public function news()
    {
        return $this->belongsTo('App\Models\News');
    }
}
