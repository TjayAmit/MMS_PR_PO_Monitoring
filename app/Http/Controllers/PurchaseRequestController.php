<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '120');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\PurchaseRequest;

class PurchaseRequestController extends Controller
{
    
    public function importPurchaseRequestFromBizzBox()
    {
        try{

            PurchaseRequest::truncate();

            //Fetch purchase list from bizzbox removing test data.
            $data = DB::connection("sqlsrv")->SELECT("SELECT c.qty * ISNULL(d.lastpurcprice, 0) AS Price, a.PK_TRXNO,
            a.docdate AS PRDate,a.remarks, b.description AS Department
            FROM dbo.iwPRinv AS a INNER JOIN
            dbo.mscWarehouse AS b ON a.FK_mscWarehouseFROM = b.PK_mscWarehouse INNER JOIN
            dbo.iwPRitem AS c ON c.FK_TRXNO = a.PK_TRXNO INNER JOIN
            dbo.iwItems AS d ON c.FK_iwItems = d.PK_iwItems LEFT JOIN
            dbo.iwPOitem AS po ON po.FK_iwPRitem = c.PK_iwPritem WHERE po.FK_TRXNO is null 
            ORDER BY a.PK_TRXNO");
            
            $bizzbox_primaryKey = '';  

            foreach($data as $key => $val)
            {
                if($bizzbox_primaryKey == $val -> PK_TRXNO)
                {
                    continue;
                }

                $bizzbox_primaryKey = $val -> PK_TRXNO;

                $department = DB::SELECT('SELECT PK_department_ID FROM department WHERE dept_name = ?',[$val -> Department]);
;
                $purchaseRequest = new PurchaseRequest();
                $purchaseRequest -> pr_Prxno = $val -> PK_TRXNO;
                $purchaseRequest -> FK_department_ID = $department[0] -> PK_department_ID;
                $purchaseRequest -> pr_remarks = $val -> remarks;
                $purchaseRequest -> pr_date = $val -> PRDate;
                $purchaseRequest -> created_at = now();
                $purchaseRequest -> updated_at = now();
                $purchaseRequest -> save();
            }

            return response() -> json([
                'status' => 200,
                'data' => "Successfully imported purchase request from bizzbox"
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
            // FETCH LIST OF PURCHASE REQUEST IN PR PO DATABASE
            $data = DB::SELECT('SELECT pr.PK_pr_ID,pr.pr_Prxno,d.dept_name,ps.procurement_description,pr.pr_date,pr.updated_at  FROM purchase_request AS pr 
            JOIN department d ON pr.FK_department_ID = d.PK_department_ID 
            JOIN procurement_status ps ON pr.FK_procurement_ID = ps.PK_procurement_ID');

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
            $data -> pr_department = $request -> Department;
            $data -> pr_remarks = $request -> Remarks;
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
            // $data = PurchaseRequest::findOrFail($request -> PK_pr_ID);

            // $data -> pr_Prxno = $request -> PRXNO;
            // $data -> pr_department = $request -> Department;
            // $data -> pr_remarks = $request -> Remarks;
            // $data -> save();

            $res = DB::SELECT("UPDATE purchase_request SET FK_procurement_ID = 1");

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
