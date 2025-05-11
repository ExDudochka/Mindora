<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examtest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'status',
        'author_id',
    ];

    public function questions(){ return $this->hasMany(Question::class); }
}
