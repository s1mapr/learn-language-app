<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'text_id'
    ];

    public function words(){
        return $this->belongsToMany(Word::class);
    }

    public function text(){
        return $this->belongsTo(Text::class);
    }
}
