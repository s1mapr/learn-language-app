<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner_url',
        'poster_url',
        'status',
        'text_id'
    ];

    public function words(){
        return $this->belongsToMany(Word::class);
    }

    public function text(){
        return $this->belongsTo(Text::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, "user_word_collections", "word_collection_id", "user_id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
