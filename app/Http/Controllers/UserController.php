<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{

    public function index(Request $request)
    {
        try{
            $data = DB::SELECT("SELECT  u.id, p.first_name,p.middle_name,p.last_name,d.dept_name as department, 
                CASE WHEN u.status = 0 THEN 'PENDING' ELSE 'APPROVED' END as status 
                FROM users u JOIN profile p ON p.FK_user_ID = u.id 
                JOIN department d ON d.PK_department_ID = p.FK_department_ID");

            return response() -> json([
                'status' => 200,
                'data' => $data
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function ifHasTokenValidation(Request $request)
    {
        try{
            $user = $request -> user();
            
            $account = DB::SELECT('SELECT p.PK_profile_ID,p.first_name,p.middle_name, r.name as role,
                p.last_name,d.dept_name as department,p.FK_role_ID as FROM profile p 
                JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                JOIN role r ON r.PK_role_ID = p.FK_role_ID
                WHERE p.FK_user_ID = ?',[$user -> id]); 
            
            $response -> name = $account[0] -> first_name.' '.$account[0] -> last_name;
            $response -> department = $account[0] -> department;
            $response -> role = $account[0] -> role;

            return response() -> json([
                'status' => 200,
                'data' => $response
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function signIn(Request $request)
    {
        try{
            //Fetch user email on database to use for validating user account
            $data = DB::SELECT("SELECT id,email,password,status FROM users u  WHERE name = ?",[$request["username"]]);

            if(!$data)
            {
                return response() -> json([
                    "status" => 404,
                    "message" => "No Account was found for user ".$request['username'].'.'
                ]);
            }

            if($data[0] -> status === 0)
            {   
                return response() -> json([
                    'status' => 401,
                    'message' => 'You are not approved'
                ]);
            }

            if(Auth::attempt(['email' => $data[0] -> email,'password' => $request -> password]))
            {
                $account = DB::SELECT('SELECT p.PK_profile_ID,p.first_name,p.middle_name,p.last_name ,d.dept_name as department,p.FK_role_ID,r.name as role FROM profile p 
                    JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                    JOIN role r ON r.PK_role_ID = p.FK_role_ID 
                    WHERE p.FK_user_ID = ?',[$data[0] -> id]); 

                if(!$account)
                {
                    return response() -> json([
                        'status' => 404,
                        'path' => "/account"
                    ]) -> withCookie(cookie('i?',$data[0] -> id, 60));
                }

                $name = $account[0] -> first_name.' '.$account[0] -> last_name;
                $user = Auth::user();
                $token = $user -> createToken($request -> ip());
                $res['name'] = $name;
                $res['department'] = $account[0] -> department;
                $res['role'] = $account[0] -> role;
                
                return response() -> json([
                    "status" => 200,
                    "data" => $res
                ]) -> withCookie(cookie('Token',$token -> plainTextToken,120));
            }
            
            return response() -> json([
                'status' => 401,
                'message' => "Email or password incorrect"
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                "status" => 500,
                "message" => $th -> getMessage()
            ]);
        }
    }

    public function signUp(Request $request)
    {
        try{

            $user = new User;
            $user -> name = $request -> username;
            $user -> email = $request -> email;
            $user -> profile = null;
            $user -> password = Hash::make($request -> password);
            $user -> status = 1;
            $user -> created_at = now();
            $user -> updated_at = now();
            $user -> save();
            
            $minute = 60;

            return response() -> json([
                'status' => 200,
                'data' => "Account register."
            ]) -> withCookie(cookie('identity',$user -> id, $minute));
            
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function signUpAccount(Request $request)
    {
        try{
            $hasCookie = $request -> hasCookie('i?');

            if(!$hasCookie)
            {   
                return response() -> json([
                    'status' => 404,
                    'message' => 'Something went wrong, identity not found.'
                ]);
            }
            
            $userID = $request -> cookie('identity');

            $profile = new Profile();
            $profile -> first_name = $request -> firstname;
            $profile -> middle_name = $request -> middlename;
            $profile -> last_name = $request -> lastname;
            $profile -> FK_role_ID = 1;
            $profile -> FK_department_ID = $request -> PK_department_ID;
            $profile -> FK_user_ID = $userID;
            $profile -> created_at = now();
            $profile -> updated_at = now();
            $profile -> save();

            $userInformation = DB::SELECT("SELECT p.PK_profile_ID,u.status,u.email,u.password,d.dept_name as department,r.name as role FROM users u JOIN profile p ON p.FK_user_ID = u.id
                JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                JOIN role r ON r.PK_role_ID = p.FK_role_ID WHERE u.id = ?",[$userID]);       

            if($userInformation[0] -> status === 1)
            {
                if(Auth::attempt(['email' => $userInformation[0] -> email,'password' => $request -> password]))
                {
                    $user = Auth::user();
                    $token = $user -> createToken($request -> ip());

                    $response['name'] = $profile -> first_name.' '.$profile -> last_name;
                    $response['department']  = $userInformation[0] -> department;
                    $response['role'] = $userInformation[0] -> role;
                    
                    return response() -> json([
                        "status" => 200,
                        "data" => $response
                    ]) -> withCookie(cookie('Token',$token -> plainTextToken,120));
                }
            }

            return response() -> json([
                'status' => 200,
                'message' => "Please wait for approval."
            ]);
        }catch(\Throwable $th){
            return response() ->json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try{
            $user = $request -> user();

            $user -> profile = $request -> profile;
            $user -> status = $request -> status;
            $user -> save();

            return response() -> json([
                'status' => 200,
                'data' => $data
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        try{
            $user = $request -> user();

            $user -> password = Hash::make($request -> password);
            $user -> save();

            return response() -> json([
                'status' => 200,
                'data' => "Password updated."
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function updateAccount(Request $request)
    {
        try{
            $user = $request -> user();


            $profile = DB::SELECT("SELECT FROM user WHERE FK_user_ID = ?",[$request -> id]);

            $data = Profile::findOrFail($profile[0] -> PK_profile_ID);
            $data -> first_name = $request -> firstname;
            $data -> middle_name = $request -> middlename;
            $data -> last_name = $request -> lastname;
            $data -> save();


            return rsponse() -> json([
                'staus' => 200,
                'dat' => $data
            ]);
        }catch(\Throable $th){
            return rpsonse() -> json([
                'staus' => 500,
                'mesage' => $th -> getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try{
            $user = $request -> user();

            $user -> delete();

            return response() -> json([
                'status' => 200,
                'data' => 'Account deleted.'
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

}
