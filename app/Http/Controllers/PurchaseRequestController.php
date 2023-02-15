<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '500');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\PurchaseRequest;
use App\Models\Procurement;
use App\Models\Items;

class PurchaseRequestController extends Controller
{
    
    public function importPurchaseRequestFromBizzBox()
    {
        try{
            $userID = 1;

            //Fetch purchase list from bizzbox removing test data.
            $data = DB::connection("sqlsrv")->SELECT("SELECT  a.PK_TRXNO,
                        d.PK_iwItems, d.remarks, d.itemdesc, d.unit, c.qty,c.qty * ISNULL(d.lastpurcprice, 0) AS Price,
                        a.docdate AS PRDate,a.remarks, b.description AS Department
                        FROM dbo.iwPRinv AS a INNER JOIN
                        dbo.mscWarehouse AS b ON a.FK_mscWarehouseFROM = b.PK_mscWarehouse INNER JOIN
                        dbo.iwPRitem AS c ON c.FK_TRXNO = a.PK_TRXNO INNER JOIN
                        dbo.iwItems AS d ON c.FK_iwItems = d.PK_iwItems LEFT JOIN
                        dbo.iwPOitem AS po ON po.FK_iwPRitem = c.PK_iwPritem WHERE po.FK_TRXNO is null
                        ORDER BY a.PK_TRXNO");

            $bizzbox_primaryKey = '';  
            // changes apply to import all products available in Purchase Ruquest
            // This is need to be able attach produrement description per product
            // Importing from BizzBox advice that it should only be imported from end of day for it will use the entire server any other request may be queed this will take time.

            foreach($data as $key => $val)
            {
                
                $pr = DB::SELECT('SELECT * FROM purchase_request WHERE pr_Prxno = ?', [$val -> PK_TRXNO]);
                $item = DB::SELECT('SELECT * FROM items WHERE PK_iwItems = ?', [$val -> PK_iwItems]);

                // Check if the Purchase Request Transaction Number exist and if does ignore
                // Including if Product ID exist
                // to prevent changes in existing procurement mode.

                if($pr && $item)
                { continue; }

                // Check for any dummy data
                if($val -> remarks === "test" OR 
                        $val -> remarks === "TESTING" OR 
                            $val -> remarks === "WRONG ENTRY" OR 
                                $val -> remarks === "test" OR
                                    $val -> remarks === "sample entry only"
                    ){
                    continue;
                }

                // Fetch department Primary key to associate to the purchase request that match the department name from BizzBox
                $department = DB::SELECT('SELECT PK_department_ID FROM department WHERE dept_name = ?',[$val -> Department]);


                if($bizzbox_primaryKey === $val -> PK_TRXNO){
                    // Register product under a specific Purchase Request
                    $item = new Items();
                    $item -> PK_iwItems = $val -> PK_iwItems;
                    $item -> description = $val -> itemdesc;
                    $item -> quantity = $val -> qty;
                    $item -> unit = $val -> unit;
                    $item -> price = $val -> Price;
                    $item -> FK_pr_ID = $pr[0] -> PK_pr_ID;
                    $item -> created_at = now();
                    $item -> updated_at = now();
                    $item -> save();
                }else{
                    $purchaseRequest = new PurchaseRequest();
                    $purchaseRequest -> pr_Prxno = $val -> PK_TRXNO;
                    $purchaseRequest -> FK_department_ID = $department[0] -> PK_department_ID;
                    $purchaseRequest -> pr_remarks = $val -> remarks ===  NULL? "NO REMARKS" : $val -> remarks ;
                    $purchaseRequest -> pr_date = $val -> PRDate;
                    $purchaseRequest -> created_at = now();
                    $purchaseRequest -> updated_at = now();
                    $purchaseRequest -> save();

                    // Register Procurement for Distinct PR only
                    $procurement = new Procurement();
                    $procurement -> procurement_description = "Pending";
                    $procurement -> FK_pr_ID = $purchaseRequest -> PK_pr_ID;
                    $procurement -> created_at = now();
                    $procurement -> updated_at = now();
                    $procurement -> save();

                    // Register product under a specific Purchase Request
                    $item = new Items();
                    $item -> PK_iwItems = $val -> PK_iwItems;
                    $item -> description = $val -> itemdesc;
                    $item -> quantity = $val -> qty;
                    $item -> unit = $val -> unit;
                    $item -> price = $val -> Price;
                    $item -> FK_pr_ID = $purchaseRequest -> PK_pr_ID;
                    $item -> created_at = now();
                    $item -> updated_at = now();
                    $item -> save();
                }
                
                $bizzbox_primaryKey = $val -> PK_TRXNO;
            }

            $res = $this -> registerLogs("Import Purchase Request",null, $userID);

            return response() -> json(['data' => "Successfully imported purchase request from bizzbox"],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function index()
    {
        try{
            // FETCH LIST OF PURCHASE REQUEST IN PR PO DATABASE
            $data = DB::SELECT('SELECT  pr.PK_pr_ID, pr.pr_no, pr.rcc,pr.fund_cluster,pr.pr_Prxno,d.dept_name,
            pr.sol_no, pr.procurement_date, pr.posting_date, pr.opening_date,
            ps.procurement_description,pr.pr_date as date,pr.updated_at  FROM purchase_request AS pr 
            JOIN department d ON pr.FK_department_ID = d.PK_department_ID 
            JOIN procurement_record ps ON ps.FK_pr_ID = pr.PK_pr_ID ORDER BY pr.pr_date DESC');

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
            $data = new PurchaseRequest;

            $data -> pr_Prxno = $request -> PRXNO;
            $data -> pr_department = $request -> Department;
            $data -> pr_remarks = $request -> Remarks;
            $data -> save();

            $res = $this -> registerLogs($ip,"Post", $data -> PK_pr_ID, $userID);

            return response() -> json(['data' => 'Purchase Request has successfully registered.'],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function show($id)
    {
        try{
            $data = DB::SELECT('SELECT * FROM purchase_request WHERE PK_pr_ID = ?',[$id]);

            if(!$data){
                return response() -> json(['message' => "No record found."],404);
            }

            return response() -> json(["data" => $data[0]], 200);

        }catch(\Throwable $th){
            return response() -> json(["message" => $th -> getMessage()],500);
        }
    }

    public function update(Request $request)
    {
        try{
            
            $ip = $request -> ip();
            // $data = PurchaseRequest::findOrFail($request -> PK_pr_ID);

            // $data -> pr_Prxno = $request -> PRXNO;
            // $data -> pr_department = $request -> Department;
            // $data -> pr_remarks = $request -> Remarks;
            // $data -> save();
            $userID = 1;

            $pr = PurchaseRequest::findOrFail($request -> id);
            $pr -> procurement_description = $request -> description;
            $pr -> updated_at = now();
            $pr -> save();

            $res = $this -> registerLogs($ip,"Update", $request -> id, $userID);

            return response() -> json(['data' => "Purchase Request successfully updated."],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function destroy($id)
    {
        try{
            $userID = 1;
            $ip = $request -> ip();

            $data = PurchaseRequest::findOrFail($id);
            $data = delete();

            $res = $this -> registerLogs($ip,"Delete", $id, $userID);

            return response() -> json(['data' => "Successfully deleted."],200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()],500);
        }
    }

    public function registerLogs($task, $id, $userID)
    {
        try{
            $data = new Logs();
            $data -> task = $task;
            $data -> table_name = "Purchase Request";
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
