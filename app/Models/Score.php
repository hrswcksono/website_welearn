<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';
    protected $primarykey = 'id_score';

    protected $fillable = [
        'id_user',
        'id_soal',
        'score',
        'date_time',
    ];
}