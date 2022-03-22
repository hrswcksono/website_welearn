<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;

use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    public function showScoreHuruf()
    {
        $data['scoreHuruf'] = DB::table('score')->get();
        // $data['scoreHuruf'] = app('firebase.firestore')->database()->collection('Score')->documents();
        return view('score.scorehuruf');
    }

    public function showScoreAngka()
    {
        $data['scoreAngka'] = app('firebase.firestore')->database()->collection('Score')->documents();
        return view('score.scoreangka');
    }
}
