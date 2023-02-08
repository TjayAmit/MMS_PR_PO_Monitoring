<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Procurement;

class ProcurementController extends Controller
{

    public function index()
    {
        try{
            $data = DB::SELECT('SELECT * FROM procurement_status');

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
            $data = new Procurement;
            $data -> procurement_description = $request -> description;
            $data -> created_at = now();
            $data -> updated_at = now();
            $data -> save();

            return response() -> json([
                'status' => 200,
                'data' => 'Procurement status description successfully registered.'
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
            $data = DB::SELECT('SELECT * FROM procurement_status WHERE PK_procurement_ID = ?',[$request -> PK_procurement_ID]);

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
            $data = Procurement::findOrFail($request -> PK_procurement_ID);

            $data -> procurement_desc = $request -> procurement_description;
            $data -> updated_at = now();
            $data -> save();
            
            return response() -> json([
                'status' => 200,
                'data' => 'Procurement status description has successfully updated.'
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try{

            $data = Procurement::findOrFail($id);
            $data -> delete();

            return response() -> json([
                'status' => 200,
                'data' =>'Procurement description has successfully deleted.'
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }
}
