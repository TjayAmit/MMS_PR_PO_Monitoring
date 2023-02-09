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

            if($data[0] -> status === 0)
            {   
                return response() -> json(['message' => 'You are not approved'],401);
            }

            if(Auth::attempt(['email' => $data[0] -> email,'password' => $request -> password]))
            {
                $account = DB::SELECT('SELECT p.PK_profile_ID,p.first_name,p.middle_name,p.last_name ,d.dept_name as department,p.FK_role_ID,r.name as role FROM profile p 
                    JOIN department d ON d.PK_department_ID = p.FK_department_ID 
                    JOIN role r ON r.PK_role_ID = p.FK_role_ID 
                    WHERE p.FK_user_ID = ?',[$data[0] -> id]); 

                if(!$account)
                {
                    return response() -> json(['path' => "/account"],404) -> withCookie(cookie('i?',$data[0] -> id, 60));
                }

                $name = $account[0] -> first_name.' '.$account[0] -> last_name;
                $user = Auth::user();
                $token = $user -> createToken($request -> ip());
                $res['name'] = $name;
                $res['department'] = $account[0] -> department;
                $res['role'] = $account[0] -> role;
                
                return response() -> json(["data" => $res],200) -> withCookie(cookie('Token',$token -> plainTextToken,120));
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
            $user -> status = 1;
            $user -> created_at = now();
            $user -> updated_at = now();
            $user -> save();
            
            $minute = 60;

            return response() -> json(['data' => "Account register."],200) -> withCookie(cookie('identity',$user -> id, $minute));
            
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function signUpAccount(Request $request)
    {
        try{
            $hasCookie = $request -> hasCookie('i?');

            if(!$hasCookie)
            {   
                return response() -> json(['message' => 'Something went wrong, identity not found.'],404);
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
                    
                    return response() -> json(["data" => $response],200) -> withCookie(cookie('Token',$token -> plainTextToken,120));
                }
            }

            return response() -> json(['message' => "Please wait for approval."],200);
        }catch(\Throwable $th){
            return response() ->json(['message' => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            $userID = 1;
            $data = User::findOrFail($request -> id);
            $data -> status = $request -> status;
            $data -> updated_at = now();
            $data -> save();

            $res = $this -> registerLogs("Account Status Update", $request -> id, $userID);

            return response() -> json(["data" => $data],200);

        } catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function changePassword(Request $request)
    {
        try{
            $userID = 1;
            $user = $request -> user();

            $user -> password = Hash::make($request -> password);
            $user -> save();

            $res = $this -> registerLogs("Change password.", $user -> id, $userID);

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
            $data -> save();


            return rsponse() -> json(['data' => $data],200);
        }catch(\Throable $th){
            return rpsonse() -> json(['mesage' => $th -> getMessage()],500);
        }
    }

    public function destroy($id)
    {
        try{
            $userID = 1;
            $user = $request -> user();

            $user -> delete();

            $res = $this -> registerLogs("Delete", $id,$userID);

            return response() -> json(['data' => 'Account deleted.'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function registerLogs($task, $id, $userID)
    {
        try{
            $data = new Logs();
            $data -> task = $task;
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
