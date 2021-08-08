<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;

use DB;

class ScoreController extends Controller
{
    public function showScoreHuruf()
    {
        $data['scoreHuruf'] = DB::table('score')->get();
        return view('score.scorehuruf');
    }

    public function showScoreAngka()
    {
        return view('score.scoreangka');
    }
}
