<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Procurement;
use App\Models\PurchaseRequest;

class ProcurementController extends Controller
{

    public function index()
    {
        try{
            $data = DB::SELECT('SELECT * FROM procurement_record');

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function store(Request $request)
    {
        try{
            $userID = 1;
            $ip = $request -> ip();

            $data = new Procurement;
            $data -> procurement_description = $request -> message;
            $data -> FK_pr_ID = $request -> id;
            $data -> created_at = now();
            $data -> updated_at = now();
            $data -> save();

            $pr = PurchaseRequest::find($request -> id);
            $pr -> pr_no = $request -> prNo;
            $pr -> rcc  = $request -> rcc;
            $pr -> procurement_description = $request -> message;
            $pr -> fund_cluster = $request -> fund;
            $pr -> sol_no = $request -> solNo;
            $pr -> procurement_date = $request -> procurementDate;
            $pr -> posting_date = $request -> postingDate;
            $pr -> opening_date = $request -> openingDate;
            $pr -> updated_at = now();
            $pr -> save();

            $res = $this -> registerLogs($ip,"Procurement", $data -> PK_procurement_ID, $userID);

            return response() -> json(['data' => 'Procurement status description successfully registered.'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function show($id)
    {
        try{
            $data = DB::SELECT('SELECT procurement_description as description, created_at as date FROM procurement_record WHERE FK_pr_ID = ?',[$id]);

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            $userID = 1;
            $ip = $request -> ip();

            $data = Procurement::findOrFail($request -> PK_procurement_ID);

            $data -> procurement_desc = $request -> procurement_description;
            $data -> updated_at = now();
            $data -> save();

            $res = registerLogs($ip,"Procurement", $request -> PK_procurement_ID,$userID);
            
            return response() -> json([
                'status' => 200,
                'data' => 'Procurement status description has successfully updated.'
            ]);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy(Request $request,$id)
    {
        try{
            $userID = 1;
            $ip = $request -> ip();

            $data = Procurement::findOrFail($id);
            $data -> delete();

            $res = registerLogs($ip,"Procurement",$id, $userID);

            return response() -> json(['data' =>'Procurement description has successfully deleted.'],200);
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
