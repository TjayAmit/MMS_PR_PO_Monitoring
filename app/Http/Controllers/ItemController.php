<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Items;

class ItemController extends Controller
{
    public function index()
    {
        try{

            $data = DB::SELECT("SELECT * FROM items");

            return response() -> json(["message" => $data],200);
        }catch(\Throwable $th){
            
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function store(Request $request)
    {
        try{
            $ip = $request -> ip();

            $userID = 1;

            // Register product under a specific Purchase Request
            $item = new Items();
            $item -> PK_iwItems = $request -> PK_iwItems;
            $item -> description = $request -> itemdesc;
            $item -> quantity = $request -> qty;
            $item -> unit = $request -> unit;
            $item -> price = $request -> Price;
            $item -> FK_pr_ID = $request -> PK_pr_ID;
            $item -> created_at = now();
            $item -> updated_at = now();
            $item -> save();
            
            $res = $this -> registerLogs($ip,"Post", $item -> PK_item_ID, $userID);

            return response() -> json(['data' => "Items successfully added."],200);
        } catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }
    
    public function show($id)
    {
        try{

            $data = DB::SELECT("SELECT PK_item_ID, PK_iwItems, description, quantity, unit, price, 
            (CASE WHEN procurement_remarks IS NOT NULL THEN procurement_remarks ELSE 'No Remarks' END) as remarks, (quantity * price) as total 
            FROM items WHERE FK_pr_ID = ? ",[$id]);

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            $ip = $request -> ip();

            $userID = 1;
            DB::table('items')
            ->where('PK_item_ID', $request -> PK_item_ID)
            ->update(['procurement_remarks' => $request -> remarks, 'updated_at' => now()]);


            $res = $this -> registerLogs($ip,"Update", $request -> PK_item_ID, $userID);

            return response() -> json(['data' => "Successfully updated."],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy(Request $request,$id)
    {
        try{
            $ip = $request -> ip();

            $userID = 1;
            $item = Items::findOrFail($id);
            $item -> delete();

            $res = $this -> registerLogs($ip,"Post", $id, $userID);

            return response() -> json(['data' => "Successfully deleted."],200);
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
            $data -> table_name = "Items";
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
