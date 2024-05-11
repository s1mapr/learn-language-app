<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWordCollection extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','word_collection_id','is_favorite','is_liked','is_author'];

    public function wordCollection(){
        return $this->belongsTo(WordCollection::class,'word_collection_id');
    }
}
