<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Models\User;
use Illuminate\Models\Profile;

class UserController extends Controller
{
    public function signIn(Request $request)
    {
        try{
            //Fetch user email on database to use for validating user account
            $data = DB::SELECT("SELECT email,password FROM users WHERE username = ?",[$request["username"]]);

            if($data)
            {
                return response() -> json([
                    "status" => 404,
                    "message" => "No Account was found for user ".$request['email'].'.'
                ]);
            }

            // if(Auth::attempt(['email'] => $data[0] -> email,['password'] => $request -> password))
            // {
            //     $user = Auth::user();
            //     $token = $user -> createToken('telemed');
            //     $response -> token = $token -> plainTextToken;
            //     $response -> role = $data;
            // }

            return response() -> json([
                "status" => 500,
                "data" => $response
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                "status" => 500,
                "message" => $th -> getMessage()
            ]);
        }
    }
}
