<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUser()
    {
        $data['users'] = DB::table('users')->get();
        // $data['users'] = app('firebase.firestore')->database()->collection('User')->documents();

        //query score
        return view('user.user', $data);
    }

    public function viewUser($id)
    {
        // $data['users'] = DB::table('users')->where('users.id',Auth::user()->id)
        //                                     ->get();
        // $data['users'] = DB::table('users')->get();
        // $users = users::find(id);
        // $users = user::find($id);
        $data['user'] = DB::table('users')->find($id);

        // $data['user'] = app('firebase.firestore')->database()->collection('User')->document($id)->snapshot();

        return view('user.view', $data);
        // return view('user/view', compact('user'));
    }

    public function delete(Request $r)
    {
        DB::table('users')->where('id', $r->hapus)->delete();
        // app('firebase.firestore')->database()->collection('Soal')->document($r->hapus)->delete();
        return redirect('user');
    }

}
