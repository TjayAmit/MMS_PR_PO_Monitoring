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
            $data = DB::SELECT("SELECT  u.id, u.profile, p.first_name,p.middle_name,p.last_name,d.dept_name as department, 
                CASE WHEN u.status = 0 THEN 'PENDING' ELSE 'APPROVED' END as status 
                FROM users u JOIN profile p ON p.FK_user_ID = u.id 
                JOIN department d ON d.PK_department_ID = p.FK_department_ID");

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function ifHasTokenValidation(Request $request)
    {
        try{
            $user = $request -> user();

            if(!$user){
                return response() -> json(['message' => "Un-authorized."],401);
            }
            
            $account = DB::SELECT('SELECT p.PK_profile_ID,p.first_name,p.middle_name, r.name as role,
                p.last_name,d.dept_name as department,p.FK_role_ID as FROM profile p 
                JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                JOIN role r ON r.PK_role_ID = p.FK_role_ID
                WHERE p.FK_user_ID = ?',[$user -> id]); 
            
            $response -> name = $account[0] -> first_name.' '.$account[0] -> last_name;
            $response -> department = $account[0] -> department;
            $response -> role = $account[0] -> role;

            return response() -> json(['data' => $response],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function signIn(Request $request)
    {
        try{
            //Fetch user email on database to use for validating user account
            $data = DB::SELECT("SELECT id,email,password,status FROM users u  WHERE name = ?",[$request["username"]]);

            if(!$data)
            {
                return response() -> json(["message" => "No Account was found for user ".$request['username'].'.'],404);
            }

            $account = DB::SELECT('SELECT p.PK_profile_ID,p.first_name,p.middle_name,p.last_name , 
                p.address,d.dept_name as department,p.FK_role_ID,r.name as role FROM profile p 
                JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                JOIN role r ON r.PK_role_ID = p.FK_role_ID 
                WHERE p.FK_user_ID = ?',[$data[0] -> id]); 

            if(!$account)
            {
                return response() -> json(['json' => ([
                    'data' => $data[0] -> id,
                    'path' => "/account",
                ])],302);
            }

            if($data[0] -> status == 0)
            {   
                return response() -> json(['message' => 'You are not approved'],401);
            }


            if(Auth::attempt(['email' => $data[0] -> email,'password' => $request -> password]))
            {

                $name = $account[0] -> first_name.' '.$account[0] -> last_name;
                $user = Auth::user();
                $token = $user -> createToken($request -> ip());
                $accessToken = $user->tokens()->where('name', $request -> ip())->first();
                $accessToken->forceFill(['expires_at' => now()->addHours(2),])->save();
                $res['name'] = $name;
                $res['address'] = $account[0] -> address;
                $res['department'] = $account[0] -> department;
                $res['role'] = $account[0] -> role;
                
                return response() -> json(["data" => $res, 'Token' =>  $token -> plainTextToken ],200);
            }
            
            return response() -> json(['message' => "Email or password incorrect"],401);
        }catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function signUp(Request $request)
    {
        try{

            $user = new User;
            $user -> name = $request -> username;
            $user -> email = $request -> email;
            $user -> profile = $request -> url;
            $user -> password = Hash::make($request -> password);
            $user -> status = 0;
            $user -> system = 1;
            $user -> created_at = now();
            $user -> updated_at = now();
            $user -> save();
            
            return response() -> json(['data' => $user -> id],200);
            
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function signUpAccount(Request $request)
    {
        try{

            if($request -> status  === 0){
                $user = DB::table('users')->where('id','=',$request -> id)->get();
    
    
                if(!$user)
                {   
                    return response() -> json(['message' => 'Account not found.'],404);
                }
                
    
                $profile = DB::table('profile')->where('FK_user_ID','=',$request -> id) -> get();
    
    
                return $user;
                //If user has already a profile account registered
                //signin user
                if($profile && $user[0] -> status == 1)
                {  
                    $userInformation = DB::SELECT("SELECT p.PK_profile_ID,u.status,u.email,u.password,
                        d.dept_name as department,r.name as role FROM users u JOIN profile p ON p.FK_user_ID = u.id
                        JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                        JOIN role r ON r.PK_role_ID = p.FK_role_ID WHERE u.id = ?",[$request -> id]); 
    
                    $user = Auth::user();
                    $token = $user -> createToken($request -> ip());
                    $expiration = now()->addHours(2);
                    $token->expires_at = $expiration;
                    $token->save();
                    $response['name'] = $profile[0] -> first_name.' '.$profile[0] -> last_name;
                    $response['address'] = $profile[0] -> address;
                    $response['department']  = $userInformation[0] -> department;
                    $response['role'] = $userInformation[0] -> role;
                    
                    return response() -> json(["data" => $response,"Token" => $token -> plainTextToken],200);
                }
    
                if($profile[0] != NULL)
                {
                    return response() -> json(['json' => ([
                        'exist' => True,  
                        'message' => "You already have an accout. Please wait for approval."  
                    ])],200);
                }
            }

            $profile = new Profile();
            $profile -> first_name = $request -> firstname;
            $profile -> middle_name = $request -> middlename;
            $profile -> last_name = $request -> lastname;
            $profile -> address = $request -> address;
            $profile -> FK_role_ID = 1;
            $profile -> FK_department_ID = $request -> PK_department_ID;
            $profile -> FK_user_ID = $request -> id;
            $profile -> created_at = now();
            $profile -> updated_at = now();
            $profile -> save();

            $userInformation = DB::SELECT("SELECT p.PK_profile_ID,u.status,u.email,u.password,d.dept_name as department,r.name as role FROM users u JOIN profile p ON p.FK_user_ID = u.id
                JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                JOIN role r ON r.PK_role_ID = p.FK_role_ID WHERE u.id = ?",[$request -> id]);       

            if($userInformation[0] -> status === 1)
            {
                if(Auth::attempt(['email' => $userInformation[0] -> email,'password' => $request -> password]))
                {
                    $user = Auth::user();
                    $token = $user -> createToken($request -> ip());
                    $expiration = now()->addHours(2);
                    $token->expires_at = $expiration;
                    $token->save();
                    $response['name'] = $profile -> first_name.' '.$profile -> last_name;
                    $response['address'] = $profile -> address;
                    $response['department']  = $userInformation[0] -> department;
                    $response['role'] = $userInformation[0] -> role;
                    
                    return response() -> json(["data" => $response,"Token" => $token -> plainTextToken],200);
                }
            }

            return response() -> json(['json' => ([
                "exist" => true,
                "message" => "Please wait for approval."
            ]) ],200);
        }catch(\Throwable $th){
            return response() ->json(['message' => $th -> getMessage()],500);
        }
    }

    public function show($id)
    {
        try{
            $data = DB::table('users') -> join('profile','profile.FK_user_ID','=','users.id')->where('users.id','=',$id) -> get();

            if(!$data){
                return response(['message' => "No records found"], 401);
            }

            return response(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            $userID = 1;
            $ip = $request -> ip();

            $data = User::findOrFail($request -> id);
            $data -> status = $request -> status;
            $data -> updated_at = now();
            $data -> save();

            $res = $this -> registerLogs($ip,"Account Status Update", $request -> id, $userID);

            return response() -> json(["message" => 'success'],200);

        } catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function changePassword(Request $request)
    {
        try{
            $userID = 1;
            $user = $request -> user();
            $ip = $request -> ip();

            $user -> password = Hash::make($request -> password);
            $user -> save();

            $res = $this -> registerLogs($ip,"Change password.", $user -> id, $userID);

            return response() -> json(['data' => "Password updated."],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
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
            $data -> address = $request -> address;
            $data -> save();


            return rsponse() -> json(['data' => $data],200);
        }catch(\Throable $th){
            return rpsonse() -> json(['mesage' => $th -> getMessage()],500);
        }
    }

    public function logout(Request $request)
    {
        try{
            $user = $request -> user();
            $user -> tokens() -> delete();
            
            return response() -> json(['data','Logout successfully'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy($id, Request $request)
    {
        try{
            $userID = 1;
            $user = $request -> user();
            $ip = $request -> ip();

            $user -> delete();

            $res = $this -> registerLogs($ip,"Delete", $id,$userID);

            return response() -> json(['data' => 'Account deleted.'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function registerLogs($ip, $task, $id, $userID)
    {
        try{
            $data = new Logs();
            $data -> task = $task;
            $data -> ip_address = $ip;
            $data -> table_name = "User";
            $data -> PK_ID = $id;
            $data -> FK_user_ID = $userID;
            $data -> created_at = now();
            $data -> updated_at = now();
            $data -> save();

            return "Logs registered";
        }catch(\Throwable $th){
            return "failed to create logs";
        }
    }
}
