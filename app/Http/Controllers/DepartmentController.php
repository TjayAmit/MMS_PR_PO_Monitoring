<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;

class DepartmentController extends Controller
{

    public function showBizzBox()
    {
        try{
            $data = DB::connection("sqlsrv")->SELECT("SELECT TOP 10 * from iwPritem");

            $result = array();

            foreach($data as $key => $val)
            {
                array_push($result,[
                    'PK_iwPritem' => $val -> PK_iwPritem,
                    'unit' => $val -> unit
                ]);
            }

            return response() -> json([
                'status' => 200,
                'data' => $result
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function index()
    {
        try{
           $data = DB::SELECT("SELECT * FROM department");

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
            $data = DB::SELECT('SELECT * FROM department WHERE PK_department_ID = ? ',[$request -> PK_department_ID]);

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
            $data = DB::SELECT('SELECT * FROM department WHERE PK_department_ID = ?',[$request -> PK_department_ID]);

            $data -> dept_name = $request -> dept_name;
            $data -> dept_location = $request -> dept_location;
            $data -> dept_head = $request -> dept_head;
            $data -> updated_at = now();
            $data -> save();

            return response() -> json([
                'status' => 200,
                'data' => $data,
            ]);
        } catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            
            $data = Department::findOrFail($request -> PK_department_ID);
            $data -> delete();

            return response() -> json([
                'status' => 200,
                'message' => "Department is successfully deleted" 
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }
}
