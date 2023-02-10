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
            $data = DB::SELECT('SELECT * FROM procurement_record');

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function store(Request $request)
    {
        try{
            $data = new Procurement;
            $data -> procurement_description = $request -> message;
            $data -> FK_pr_ID = $request -> id;
            $data -> created_at = now();
            $data -> updated_at = now();
            $data -> save();

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
            $data = Procurement::findOrFail($request -> PK_procurement_ID);

            $data -> procurement_desc = $request -> procurement_description;
            $data -> updated_at = now();
            $data -> save();
            
            return response() -> json([
                'status' => 200,
                'data' => 'Procurement status description has successfully updated.'
            ]);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy($id)
    {
        try{

            $data = Procurement::findOrFail($id);
            $data -> delete();

            return response() -> json(['data' =>'Procurement description has successfully deleted.'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }
}
