<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';
    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'id_jenis',
        'id_level',
        'soal',
        'keterangan',
        'jawaban',
    ];

    public $timestamps = false;
}
