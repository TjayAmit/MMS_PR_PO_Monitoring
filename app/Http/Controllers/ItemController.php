<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        try{

            $data = DB::SELECT("SELECT * FROM items");

            return response() -> json([
                "status" => 200,
                "message" => $data
            ]);
        }catch(\Throwable $th){
            
            return response() -> json([
                "status" => 500,
                "message" => $th -> getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try{

            // Register product under a specific Purchase Request
            $item = new Item();
            $item -> PK_iwItems = $request -> PK_iwItems;
            $item -> description = $request -> itemdesc;
            $item -> quantity = $request -> qty;
            $item -> unit = $request -> unit;
            $item -> price = $request -> Price;
            $item -> FK_pr_ID = $request -> PK_pr_ID;
            $item -> created_at = now();
            $item -> updated_at = now();
            $item -> save();
            

            return response() -> json([
                'status' => 200,
                'data' => "Item successfully added."
            ]);
        } catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }
    
    public function show($id)
    {
        try{

            $data = DB::SELECT("SELECT * FROM items WHERE FK_pr_ID = ? ",[$id]);

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
            $item = Item::findOrFail($request -> PK_item_ID);

            $item -> procurement_remarks = $request -> remarks;
            $item -> updated_at = now();
            $item -> save();

            return response() -> json([
                'status' => 200,
                'data' => "Successfully updated."
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try{

            $item = Item::findOrFail($request -> id);
            $item -> delete();

            return response() -> json([
                'status' => 200,
                'data' => "Successfully deleted."
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }
}
