<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examtest;

class TestAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'examtest_id',
        'score',
        'percent',
        'correct',
        'total',
        'grade',
        'is_single_attempt'
    ];

    public function user(){return $this->belongsTo(User::class,'examtest_id');}

    public function examtest(){return $this->belongsTo(Examtest::class);}
}
