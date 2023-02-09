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

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
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
            
            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function show(Request $request)
    {
        try{
            $data = DB::SELECT('SELECT * FROM role WHERE PK_role_ID = ?',[$request -> PK_role_ID]);

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            
            $data = Role::find($request['PK_profile_ID']);
            $data -> name = $request -> role_name;
            $data -> updated_at = now();
            $data -> save();

            return response() -> json(['data' => 'Role Updated.'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMesssage()],500);
        }
    }

    public function destroy($id)
    {
        try{
            $data = Role::findOrFail($id);
            $data -> delete();

            return response() -> json(['message' => "Role is successfully deleted"],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }
}
