<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Soal;
use App\Models\JenisSoal;
use App\Models\Level;
use App\Models\Gambar;

use DB;

class SoalController extends Controller
{
    // Soal Huruf
    public function showSoalHuruf()
    {
        $data['soal'] = DB::table('soal')->where('id_jenis',1)->get();
        // $data['soal'] = DB::table('soal')->get();
        $data['level'] = DB::table('level')->get();
        return view('soal.soalhuruf', $data);
    }

    // public function addSoalHuruf()
    // {
    //     $data['soal'] = DB::table('soal')->get();        
    //     return view('soal.soalhuruf', $data);
    // }

    public function storeSoalHuruf(Request $request)
    {
        $newSoalHuruf = new Soal();
        $newSoalHuruf->id_jenis = $request->id_jenis;
        $newSoalHuruf->id_level = $request->id_level;
        $newSoalHuruf->soal = $request->soal;
        $newSoalHuruf->keterangan = $request->keterangan;
        $newSoalHuruf->jawaban = $request->jawaban;

        $status = $newSoalHuruf->save();
        if($status)
        {
            return redirect('/soal_huruf'); // redirect ke /route nya
        }
    }

    public function editSoalHuruf($id)
    {
        // return view('soal.editsoalhuruf');
        $huruf = DB::table('soal')->where('id_soal',$id)->first();
        return view('soal.editsoalhuruf', ['huruf' => $huruf]);
        // return view('soal.editsoalhuruf', compact($huruf);
        
    }

    public function postSoalHuruf(Request $request)
    {
        $status = DB::table('soal')->where('id_soal', $request->id)
                                ->update(['id_jenis'=>$request->id_jenis,'id_level'=>$request->id_level,'soal'=>$request->soal,'keterangan'=>$request->keterangan,'jawaban'=>$request->jawaban]);
        if($status)
        {
            return redirect('/soal_huruf'); // redirect ke /route nya
        }
    }
    
    public function viewSoalHuruf($id)
    {
        // $data['soal'] = DB::table('soal')->where('soal.id_soal',Auth::user()->id)
        //                                     ->get();
        // return view('user.viewsoalhuruf', $data);
        // $data['soal'] = DB::table('soal')->find($id);
        // $data['soal'] = DB::table('soal')->where('id_soal', $id)->get();
        // return view('soal.viewsoalhuruf', $data);
        $huruf = DB::table('soal')->where('id_soal',$id)->first();
        return view('soal.viewsoalhuruf', ['huruf' => $huruf]);
    }

    public function deleteSoalHuruf(Request $request)
    {
        DB::table('soal')->where('id_soal', $request->hapus)->delete();
        return redirect('/soal_huruf');
    }

    // Soal Angka
    public function showSoalAngka()
    {
        $data['soal'] = DB::table('soal')->where('id_jenis',2)->get();
        $data['level'] = DB::table('level')->get();
        return view('soal.soalangka', $data);
    }

    public function storeSoalAngka(Request $request)
    {
        $newSoalAngka = new Soal();
        $newSoalAngka->id_jenis = $request->id_jenis;
        $newSoalAngka->id_level = $request->id_level;
        $newSoalAngka->soal = $request->soal;
        $newSoalAngka->keterangan = $request->keterangan;
        $newSoalAngka->jawaban = $request->jawaban;

        $status = $newSoalAngka->save();
        if($status)
        {
            return redirect('/soal_angka'); // redirect ke /route nya
        }
    }

    public function viewSoalAngka($id)
    {
        $angka = DB::table('soal')->where('id_soal',$id)->first();
        return view('soal.viewsoalangka', ['angka' => $angka]);
    }

    public function editSoalAngka($id)
    {
        // return view('soal.editsoalhuruf');
        $angka = DB::table('soal')->where('id_soal',$id)->first();
        return view('soal.editsoalangka', ['angka' => $angka]);
        // return view('soal.editsoalhuruf', compact($huruf);
        
    }
    
    public function deleteSoalAngka(Request $request)
    {
        DB::table('soal')->where('id_soal', $request->hapus)->delete();
        return redirect('/soal_angka');
    }

    public function postSoalAngka(Request $request)
    {
        $status = DB::table('soal')->where('id_soal', $request->id)
                                ->update(['id_jenis'=>$request->id_jenis,'id_level'=>$request->id_level,'soal'=>$request->soal,'keterangan'=>$request->keterangan,'jawaban'=>$request->jawaban]);
        if($status)
        {
            return redirect('/soal_angka'); // redirect ke /route nya
        }
    }

    

}