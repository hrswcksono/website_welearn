<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Gambar extends Model
// {
//     use HasFactory;

//     protected $table = 'gambar';
//     protected $primaryKey = 'id_gambar';

//     protected $fillable = [
//         'nama',
//         'gambar'
//     ];

//     public $timestamps = false;
// }

class Gambar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'gambar'
    ];    
}
