<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examtest;

class TestAttempt extends Model
{
    protected $fillable = [
        'user_id', 'examtest_id', 'score', 'percent', 'started_at', 'finished_at'
    ];

    public function user(){return $this->belongsTo(User::class);}

    public function examtest(){return $this->belongsTo(Examtest::class);}
}
