<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;

use DB;

class HomeController extends Controller
{
    public function show()
    {
        $data['count'] = DB::table('users')->count();


        $maxHuruf = DB::table('score')->join('soal', 'score.id_soal', '=', 'soal.id_soal')
        ->select(DB::raw('sum(score.score) as total_score'))
        ->where('soal.id_jenis', 1)
        ->groupBy('score.id_user')
        ->orderBy('score.score', 'asc')->get();

        foreach($maxHuruf as $mx)
        {$dat = $mx;}

        $temp = (array) $dat;
        foreach($temp as $tmp)
        {$huruf = $tmp;}
        $dataMax['maxHuruf'] = $huruf;

//         $maxHuruf['maxHuruf']=DB::table('score')
// ->join(
//     'soal',
//     'soal.id_soal',
//     '=',
//     'score.id_soal'
// )->selectRaw('score.id_user, sum(score.score)')
// ->groupBy('score.id_user')->orderBy('score.id_user', 'DESC')
// ->get();

        // ->first();
        // ->get(max(['score.id_user']));

        $maxAngka= DB::table('score')->join('soal', 'score.id_soal', '=', 'soal.id_soal')
        ->select(DB::raw('sum(score.score) as total_score'))
        ->where('soal.id_jenis', 2)
        ->groupBy('score.id_user')
        ->orderBy('score.score', 'asc')->get();
        // ->first();
        // ->get(max(['score.id_user']));
        foreach($maxAngka as $mx)
        {$dang = $mx;}

        $tank = (array) $dang;
        foreach($tank as $tmp)
        {$angka = $tmp;}
        $dataMax['maxAngka'] = $angka;
        
        return view('home.home', $data, $dataMax);
        // print_r($maxHuruf);die();
        // print_r($maxHuruf['maxHuruf'][0]->total_score);die;
        // echo '<pre>';print_r($maxHuruf);echo '</pre>';die();
        // print_r($maxHuruf['maxHuruf']['*items'][0]->total_score);die();
        
    }
}
