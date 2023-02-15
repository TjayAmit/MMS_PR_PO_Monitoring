<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Logs;

class DepartmentController extends Controller
{

    public function importDepartmentFromBizzBox()
    {
        try{
            $userID = 1;

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

            $res = $this -> registerLogs('Import Department Data.', null, $userID);

            return response() -> json(['data' => "Successfully registered department from the bizzbox."],200);

        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }


    public function publicSelection()
    {
        try{
            $data = DB::SELECT("SELECT PK_department_ID AS id, dept_name AS name FROM department");

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function index()
    {
        try{
           $data = DB::SELECT("SELECT d.PK_department_ID, d.dept_PK_msc_warehouse, d.dept_name,
           (SELECT count(p.PK_pr_ID) FROM purchase_request p WHERE p.FK_department_ID = d.PK_department_ID) as total_pr, 
           d.dept_shortname, d.created_at as date FROM department d");

            return response() -> json(['data' => $data],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function show(Request $request)
    {
        try{
            $userID = 1;
            $data = DB::SELECT('SELECT * FROM department WHERE PK_department_ID = ? ',[$request -> PK_department_ID]);

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
            $data = DB::SELECT('SELECT * FROM department WHERE PK_department_ID = ?',[$request -> PK_department_ID]);

            $data -> dept_name = $request -> dept_name;
            $data -> dept_location = $request -> dept_location;
            $data -> updated_at = now();
            $data -> save();

            $res = $this -> registerLogs($ip,'Update',$request -> PK_department_ID, $userID);

            return response() -> json(['data' => $data],200);
        } catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy(Request $request,$id)
    {
        try{
            $userID = 1;
            $ip = $request -> ip();

            $data = Department::findOrFail($id);
            $data -> delete();

            $res = $this -> registerLogs($ip,'Delete', $id, $userID);

            return response() -> json(['message' => "Department is successfully deleted"],200);
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
            $data -> table_name = "Department";
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
