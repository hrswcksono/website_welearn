<?php

namespace App\Http\Controllers\API\V1\Globals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class UserController extends Controller {
    
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('WeLearn')->accessToken;
            return response()->json(['success'=>config('global.http.200'), 'message'=>$success], 200);
        }
        else{
            return response()->json(['error'=>config('global.http.401'), 'message'=>'Unauthorised'], 401);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        ini_set('max_execution_time','300');
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'username' => 'required',
            // 'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            // 'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>config('global.http.400'), 'message'=>$validator->errors()], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('WeLearn')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>config('global.http.201'), 'message'=>$success], 201);
    }

    /**
     * logout api
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        $logout = $request->user()->token()->revoke();
        if($logout){
            return response()->json(['success'=>config('global.http.200'), 'message'=>'Successfully logged out'], 200);
        } else {
            return response()->json(['error'=>config('global.http.401'), 'message'=>'Unauthorised'], 401);
        }
    }

    /**
     * detail api
     *
     * @return \Illuminate\Http\Response
     */
    public function detail() {
        $user = Auth::user();
        $scoreHuruf['score'] = DB::table('score')->join('soal', 'score.id_soal', '=', 'soal.id_soal')->where('soal.id_jenis', 1)
        ->where('score.id_user', $user->id)->sum('score.score');
        $scoreAngka['score'] = DB::table('score')->join('soal', 'score.id_soal', '=', 'soal.id_soal')->where('soal.id_jenis', 2)
        ->where('score.id_user', $user->id)->sum('score.score');
        // return response()->json(['success'=>config('global.http.200'), 'message'=>$user], 200);
        return response()->json(['success'=>config('global.http.200'), 'message'=>['username'=>$user->username, 'email'=>$user->email, 'jenis_kelamin'=>$user->jenis_kelamin, 'score'=>$scoreHuruf['score'], 'angka'=>$scoreAngka['score']]], 200);
    }

    
}