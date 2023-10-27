<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'category', 'user_id','vote_count','confirm'];

    public static $rules = [
        'title' => 'required|max:255',
        'description' => 'required',
        'category' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
   {
    return $this->hasMany(Comment::class);
   }
}
