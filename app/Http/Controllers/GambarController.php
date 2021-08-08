<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Models\Gambar;

class GambarController extends Controller
{
    public function viewGambar()
    {
        return view('konversi.konversigambar');
    }

    public function uploadGambar(Request $request)
    {
        $this->validate($request, [
            'gambar' => 'required | image',
            'nama' => 'required',
        ]);

        //menyimpan data gambar ke variabel $gambar
        $gambar = $request->file('gambar');
        
        $nama_gambar = time()."_".$gambar->getClientOriginalName();

        $tujuan_upload = public_path().'\\upload_gambar';
        $gambar->move($tujuan_upload, $nama_gambar);

        Gambar::create([
            'nama' => $request->nama,
            'gambar' => $nama_gambar,
        ]);

        return redirect()->back();
    }

}
