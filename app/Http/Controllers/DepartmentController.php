<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;

class DepartmentController extends Controller
{

    public function importDepartmentFromBizzBox()
    {
        try{
            //Fetch department list from bizzbox removing test data.
            $data = DB::connection("sqlsrv")->SELECT("SELECT * from mscWarehouse WHERE description <> 'Not Applicable'");

            $result = array();

            foreach($data as $key => $val)
            {
                $department = new Department();
                $department -> dept_PK_msc_warehouse = $val -> PK_mscWarehouse;
                $department -> dept_name = $val -> description;
                $department -> dept_shortname = $val -> shortname  == NULL ? "NONE" : $val -> shortname;
                $department -> created_at = now();
                $department -> updated_at = now();
                $department -> save();
            }

            return response() -> json([
                'status' => 200,
                'data' => "Successfully registered department from the bizzbox."
            ]);

        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }


    public function publicSelection()
    {
        try{
            $data = DB::SELECT("SELECT PK_department_ID AS id, dept_name AS name FROM department");

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

    public function index()
    {
        try{
           $data = DB::SELECT("SELECT d.PK_department_ID, d.dept_PK_msc_warehouse, d.dept_name,
           (SELECT count(p.PK_pr_ID) FROM purchase_request p WHERE p.FK_department_ID = d.PK_department_ID) as total_pr, 
           d.dept_shortname, d.created_at FROM department d");

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
