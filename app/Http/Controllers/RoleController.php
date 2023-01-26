<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        try{
            $data = DB::SELECT('SELECT * FROM role');

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

    public function store(Request $request)
    {
        try{
            $data = new Role;

            $data->name = $request ->role_name;
            $data->created_at = now();
            $data->updated_at = now();
            $data -> save();
            
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

    public function show(Request $request)
    {
        try{
            $data = DB::SELECT('SELECT * FROM role WHERE PK_role_ID = ?',[$request -> PK_role_ID]);

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

    public function update(Request $request)
    {
        try{
            
            $data = Role::find($request['PK_profile_ID']);
            $data -> name = $request -> role_name;
            $data -> updated_at = now();
            $data -> save();

            return response() -> json([
                'status' => 200,
                'data' => 'Role Updated.'
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMesssage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $data = Role::findOrFail($request -> PK_role_ID);
            $data -> delete();

            return response() -> json([
                'status' => 200,
                'message' => "Role is successfully deleted" 
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }
}
