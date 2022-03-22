<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class FirebaseController extends Controller
{
    protected $auth, $database;

    public function __construct()
    {
        $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/firebase-credentials.json')
        ->withDatabaseUri('https://welearn-73108-default-rtdb.firebaseio.com/');

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();
    }

    public function testLogin(){

        $idToken = "eyJhbGciOiJSUzI1NiIsImtpZCI6ImIwNmExMTkxNThlOGIyODIxNzE0MThhNjdkZWE4Mzc0MGI1ZWU3N2UiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiSm9obiBEb2UiLCJwaWN0dXJlIjoiaHR0cDovL3d3dy5leGFtcGxlLmNvbS8xMjM0NTY3OC9waG90by5wbmciLCJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vd2VsZWFybi03MzEwOCIsImF1ZCI6IndlbGVhcm4tNzMxMDgiLCJhdXRoX3RpbWUiOjE2NDc5MTE0MjIsInVzZXJfaWQiOiJrYXhhOERWcU9qYU5rcXJuVXNGc2NNajBWODUzIiwic3ViIjoia2F4YThEVnFPamFOa3FyblVzRnNjTWowVjg1MyIsImlhdCI6MTY0NzkxMTQyMiwiZXhwIjoxNjQ3OTE1MDIyLCJlbWFpbCI6InRlczEyMzQ1Njc4OUBleGFtcGxlLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwicGhvbmVfbnVtYmVyIjoiKzE0NDUzNTIwMTAwIiwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJwaG9uZSI6WyIrMTQ0NTM1MjAxMDAiXSwiZW1haWwiOlsidGVzMTIzNDU2Nzg5QGV4YW1wbGUuY29tIl19LCJzaWduX2luX3Byb3ZpZGVyIjoicGFzc3dvcmQifX0.KT7IHH689wYgocs_yP7ihZoo-4nRHfya3WY9S4dWsj80AB2oRI41dS5c9C0brfbhblQGXncMP7sAeAGjK8YFxUdTkz4-jKsVj8JIBWOe6lEDiQ68DF0acu_27MGDg3Ip5V6zwACCXUBFN_dcUlWAz6oJP0_1eIm8EC0Rxj5aiCyM9NklJp_Aq8IaKjSmEgrlnrcBZNhz0_DFLRKvH4egRHGBmLhzOimCUI1wB4nDTcrmRWFkxnWkhUkq4Z1z9fvZVxPa-U9nXpwGww4j-U5Anl32JlLwH7aOtGouGzstr8YU5IAPrSTglQWMZsDfKXN3T-n-ZQLVrTmtLkLrKwiu6Q";

        try {
            $signInResult = $this->auth->verifyIdToken($idToken);
            // dump($signInResult->data());
            // $signInResult = $this->auth->signInWithEmailAndPassword($email, $pass);

            // Session::put('firebaseUserId', $signInResult->firebaseUserId());
            // Session::put('idToken', $signInResult->idToken());
            // Session::save();

            dd($signInResult);
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'INVALID_PASSWORD':
                    dd("Kata sandi salah!.");
                    break;
                case 'EMAIL_NOT_FOUND':
                    dd("Email tidak ditemukan.");
                    break;
                default:
                    dd($e->getMessage());
                    break;
            }
        }
    }

    public function signUp()
    {
        $email = "angelicdemon@gmail.com";
        $pass = "anya123";

        $userProperties = [
            'email' => 'tes123456789@example.com',
            'emailVerified' => false,
            'phoneNumber' => '+14453520100',
            'password' => 'tes12345',
            'displayName' => 'John Doe',
            'photoUrl' => 'http://www.example.com/12345678/photo.png',
            'disabled' => false,
            'customClaims' => [
                'umur' => '18',
            ],
        ];
        
        try {
            // $newUser = $this->auth->createUserWithEmailAndPassword($email, $pass);
            $newUser = $this->auth->createUser($userProperties);
            dd($newUser);
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'The email address is already in use by another account.':
                    dd("Email sudah digunakan.");
                    break;
                case 'A password must be a string with at least 6 characters.':
                    dd("Kata sandi minimal 6 karakter.");
                    break;
                default:
                    dd($e->getMessage());
                    break;
            }
        }
    }

    public function getInfo()
    {
        try {
            // $user = $this->auth->getUser('zd3CVN48e5TR8LiZZZDmvCPO5A22');
            $user = $this->auth->getUserByEmail('tes123456@example.com');
            // $user = $this->auth->getUserByPhoneNumber('+49-123-456789');
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            echo $e->getMessage();
        }
        ddd($user);
    }

    public function signIn()
    {
        $email = "tes123456789@example.com";
        $pass = "tes12345";
        // $pass = "anya123";

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $pass);
            // dump($signInResult->data());

            Session::put('firebaseUserId', $signInResult->firebaseUserId());
            Session::put('idToken', $signInResult->idToken());
            Session::save();

            dd($signInResult);
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'INVALID_PASSWORD':
                    dd("Kata sandi salah!.");
                    break;
                case 'EMAIL_NOT_FOUND':
                    dd("Email tidak ditemukan.");
                    break;
                default:
                    dd($e->getMessage());
                    break;
            }
        }
    }

    public function signOut()
    {
        if (Session::has('firebaseUserId') && Session::has('idToken')) {
            // dd("User masih login.");
            $this->auth->revokeRefreshTokens(Session::get('firebaseUserId'));
            Session::forget('firebaseUserId');
            Session::forget('idToken');
            Session::save();
            dd("User berhasil logout.");
        } else {
            dd("User belum login.");
        }
    }

    public function userCheck()
    {
        $idToken = "eyJhbGciOiJSUzI1NiIsImtpZCI6ImIwNmExMTkxNThlOGIyODIxNzE0MThhNjdkZWE4Mzc0MGI1ZWU3N2UiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiSm9obiBEb2UiLCJwaWN0dXJlIjoiaHR0cDovL3d3dy5leGFtcGxlLmNvbS8xMjM0NTY3OC9waG90by5wbmciLCJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vd2VsZWFybi03MzEwOCIsImF1ZCI6IndlbGVhcm4tNzMxMDgiLCJhdXRoX3RpbWUiOjE2NDc5MTc4MTEsInVzZXJfaWQiOiJrYXhhOERWcU9qYU5rcXJuVXNGc2NNajBWODUzIiwic3ViIjoia2F4YThEVnFPamFOa3FyblVzRnNjTWowVjg1MyIsImlhdCI6MTY0NzkxNzgxMSwiZXhwIjoxNjQ3OTIxNDExLCJlbWFpbCI6InRlczEyMzQ1Njc4OUBleGFtcGxlLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwicGhvbmVfbnVtYmVyIjoiKzE0NDUzNTIwMTAwIiwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJwaG9uZSI6WyIrMTQ0NTM1MjAxMDAiXSwiZW1haWwiOlsidGVzMTIzNDU2Nzg5QGV4YW1wbGUuY29tIl19LCJzaWduX2luX3Byb3ZpZGVyIjoicGFzc3dvcmQifX0.l05A_60aRYzVWlR2Zezpta_Kmyu8nHJFFV1qRBOfoJ1jXfNSAu-B2J704msYXeJjzAEQJf4EMupVGad7CgmIepOENPOiXBuClTdvhIkDHDx9HWPLehZm_BqCZZU7uzqJ-kvNnUS3GHtfOkEv2v1UoGQD_XhUSU39yL9P00tudVaFjfge2Bu6DfebTSG5yYq2JBN5OcXt-E4BfrlIO03oHOE8aglNPUP-ExVrbj6V4TwPPUZQX2971KIGI9TJBFobobCm5hPfHi4dTB0MKBiqbU3oqnImyOYcLhEtO1gOlvlGsL1dF0vSEIC1-UIh88u9SXKvThxCrNzrBJsdcOR3Tg";

        // $this->auth->revokeRefreshTokens("");

        // if (Session::has('firebaseUserId') && Session::has('idToken')) {
        //     dd("User masih login.");
        // } else {
        //     dd("User sudah logout.");
        // }

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken, $checkIfRevoked = true);
            dump($verifiedIdToken);
            dump($verifiedIdToken->claims()->get('sub')); // uid
            dump($this->auth->getUser($verifiedIdToken->claims()->get('sub')));
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }

        // try {
        //     $verifiedIdToken = $this->auth->verifyIdToken(Session::get('idToken'), $checkIfRevoked = true);
        //     $response = "valid";
        //     // dd("Valid");
        //     // $uid = $verifiedIdToken->getClaim('sub');
        //     // $user = $auth->getUser($uid);
        //     // dump($uid);
        //     // dump($user);
        // } catch (\InvalidArgumentException $e) {
        //     // dd('The token could not be parsed: '.$e->getMessage());
        //     $response = "The token could not be parsed: " . $e->getMessage();
        // } catch (InvalidToken $e) {
        //     // dd('The token is invalid: '.$e->getMessage());
        //     $response = "The token is invalid: " . $e->getMessage();
        // } catch (RevokedIdToken $e) {
        //     $response = "revoked";
        // } catch (\Throwable $e) {
        //     if (substr(
        //         $e->getMessage(),
        //         0,
        //         21
        //     ) == "This token is expired") {
        //         $response = "expired";
        //     } else {
        //         $response = "something_wrong";
        //     }
        // }
        // return $response;
    }

    public function read()
    {
        $ref = $this->database->getReference('hewan/herbivora/domba')->getSnapshot();
        dump($ref);
        $ref = $this->database->getReference('hewan/herbivora')->getValue();
        dump($ref);
        $ref = $this->database->getReference('hewan/karnivora')->getValue();
        dump($ref);
        $ref = $this->database->getReference('hewan/omnivora')->getSnapshot()->exists();
        dump($ref);
    }

    public function update()
    {
        // before
        $ref = $this->database->getReference('tumbuhan/dikotil')->getValue();
        dump($ref);

        // update data
        $ref = $this->database->getReference('tumbuhan')
        ->update(["dikotil" => "mangga"]);

        // after
        $ref = $this->database->getReference('tumbuhan/dikotil')->getValue();
        dump($ref);
    }

    public function set()
    {
        // before
        $ref = $this->database->getReference('hewan')->getValue();
        dump($ref);

        // set data
        $ref = $this->database->getReference('hewan/karnivora')
        ->set([
            "harimau" => [
                "benggala" => "galak",
                "sumatera" => "jinak"
            ]
        ]);

        // after
        $ref = $this->database->getReference('hewan')->getValue();
        dump($ref);
    }
    
    public function delete()
    {
        // before
        $ref = $this->database->getReference('hewan/karnivora/harimau')->getValue();
        dump($ref);

        /**
         * 1. remove()
         * 2. set(null)
         * 3. update(["key" => null])
         */

        // remove()
        $ref = $this->database->getReference('hewan/karnivora/harimau/benggala')->remove();

        // set(null)
        $ref = $this->database->getReference('hewan/karnivora/harimau/benggala')
            ->set(null);

        // update(["key" => null])
        $ref = $this->database->getReference('hewan/karnivora/harimau')
            ->update(["benggala" => null]);

        // after
        $ref = $this->database->getReference('hewan/karnivora/harimau')->getValue();
        dump($ref);
    }
}
