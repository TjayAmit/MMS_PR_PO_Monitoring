<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Logs;

class LogsController extends Controller
{
    public function index()
    {
        try{
            $data = DB::SELECT("SELECT PK_log_ID, task,table_name, PK_ID, FK_user_ID, created_at as date, updated_at FROM logs");

            return response() -> json(["data" => $data],200);
        }catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }
    
    public function store(Request $request)
    {
        try{
            $user = $request -> user();

            $log = new Logs();
            $log -> task = $request -> task;
            $log -> table_name = $request -> table_name;
            $log -> PK_ID = $request -> PK_ID;
            $log -> FK_user_ID = $user -> id;
            $log -> created_at = now();
            $log -> updated_at = now();
            $log -> save();

            return response() -> json(['data' => "Success registered."],200);
        }catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function show($id)
    {
        try{   
            $data = DB::SELECT("SELECT PK_log_ID, task, table_name, PK_ID, FK_user_ID, created_at as date, updated_at FROM logs WHERE PK_logs_ID = ?",[$id]);

            return response() -> json(["data" => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            $user = $request -> user();

            $log = Logs::findOrFail($request -> id);
            
            if(!$log){
                return response() -> json(["message" => "No data found for requested log"],404);
            }

            $log -> task = $request -> task;
            $log -> table_name = $request -> table_name;
            $log -> PK_ID = $request -> PK_ID;
            $log -> FK_user_ID = $user -> id;
            $log -> updated_at = now();
            $log -> save();

            return response() -> json(['data' => "Successfully updated logs"],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy($id)
    {
        try{
            $data = Logs::findOrFail($id);

            return response() -> json(['data' => "Successfully deleted."],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }
}
