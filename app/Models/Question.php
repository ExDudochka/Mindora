<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = [
        'examtest_id',
        'content',
        'type',
        'position',
    ];

    public function options(){ return $this->hasMany(Option::class, 'question_id'); }
    public function examtest(){ return $this->belongsTo(Examtest::class); }
}
