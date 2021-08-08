<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSoal extends Model
{
    use HasFactory;

    protected $table = 'jenis_soal';
    protected $primaryKey = 'id_jenis_soal';

    public $timestamps = false;
}
