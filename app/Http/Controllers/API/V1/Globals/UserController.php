<?php

namespace App\Http\Controllers\API\V1\Globals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Firebase\Auth\Token\Exception\InvalidToken;

class UserController extends Controller {

    public function menglogin(Request $request) {
  
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
      
        
        try { // Try to verify the Firebase credential token with Google
          
          $verifiedIdToken = $auth->verifyIdToken($idTokenString);
          
        } catch (\InvalidArgumentException $e) { // If the token has the wrong format
          
          return response()->json([
              'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
          ], 401);        
          
        } catch (InvalidToken $e) { // If the token is invalid (expired ...)
          
          return response()->json([
              'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
          ], 401);
          
        }
      
        // Retrieve the UID (User ID) from the verified Firebase credential's token
        $uid = $verifiedIdToken->getClaim('sub');
      
        // Retrieve the user model linked with the Firebase UID
        $user = User::where('firebaseUID',$uid)->first();
        
        // Here you could check if the user model exist and if not create it
        // For simplicity we will ignore this step
      
        // Once we got a valid user model
        // Create a Personnal Access Token
        $tokenResult = $user->createToken('Personal Access Token');
        
        // Store the created token
        $token = $tokenResult->token;
        
        // Add a expiration date to the token
        $token->expires_at = Carbon::now()->addWeeks(1);
        
        // Save the token to the user
        $token->save();
        
        // Return a JSON object containing the token datas
        // You may format this object to suit your needs
        return response()->json([
          'id' => $user->id,
          'access_token' => $tokenResult->accessToken,
          'token_type' => 'Bearer',
          'expires_at' => Carbon::parse(
            $tokenResult->token->expires_at
          )->toDateTimeString()
        ]);
      
      }
    
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            // $user = User::all();
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

    public function test() {

    }
    
}