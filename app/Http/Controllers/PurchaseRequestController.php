<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Models\PurchaseRequest;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        try{
            $data = DB::SELECT('SELECT * FROM purchase_request');

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
            $data = new PurchaseRequest;

            $data -> pr_Prxno = $request -> PRXNO;
            $data -> pr_no    = $request -> PRNO;
            $data -> pr_department = $request -> Department;
            $data -> pr_remarks = $request -> Remarks;
            $data -> pr_reg_date = $request -> RegDate;
            $data -> save();

            return response() -> json([
                'status' => 200,
                'data' => 'Purchase Request has successfully registered.'
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
            $data = DB::SELECT('SELECT * FROM purchase_request WHERE PK_pr_ID = ?',[$request -> PK_pr_ID]);

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
            $data = PurchaseRequest::findOrFail($request -> PK_pr_ID);

            $data -> pr_Prxno = $request -> PRXNO;
            $data -> pr_no    = $request -> PRNO;
            $data -> pr_department = $request -> Department;
            $data -> pr_remarks = $request -> Remarks;
            $data -> pr_reg_date = $request -> RegDate;
            $data -> save();

            return response() -> json([
                'status' => 200,
                'data' => "Purchase Request successfully updated."
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
            $data = PurchaseRequest::findOrFail($request -> PK_pr_ID);
            $data = delete();
            
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
