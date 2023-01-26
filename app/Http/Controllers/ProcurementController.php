<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Models\Procurement;

class ProcurementController extends Controller
{

    /**
     * 
     * Fetch pr that doesn't have PO
        SELECT
            prq.PK_TRXNO,
            prq.PRNo,
            prq.Department,
            prq.remarks,
            prq.PRDate,
            pri.regdate
        FROM iwPRitem AS pr left join iwPOitem AS po
            ON pr.PK_iwPritem = po.FK_iwPRitem JOIN 
            vwReportPurchaseRequest AS prq ON prq.PK_TRXNO = pr.FK_TRXNO JOIN
            iwPRinv pri ON prq.PK_TRXNO = pri.PK_TRXNO;
     * 
     * Fetch with filtered pr
        SELECT
            prq.PK_TRXNO,
            prq.PRNo,
            prq.Department,
            prq.remarks,
            prq.PRDate,
            pri.regdate
        FROM iwPRitem AS pr left join iwPOitem AS po
            ON pr.PK_iwPritem = po.FK_iwPRitem JOIN 
            vwReportPurchaseRequest AS prq ON prq.PK_TRXNO = pr.FK_TRXNO JOIN
            iwPRinv pri ON prq.PK_TRXNO = pri.PK_TRXNO
            GROUP BY prq.PK_TRXNO
            HAVING prq.PK_TRXNO = 23671235 AND po.FK_TRXNO is null;

            
        SELECT
            prq.PK_TRXNO,
            prq.PRNo,
            prq.Department,
            prq.remarks,
            prq.PRDate,
            pri.regdate
        FROM iwPRitem AS pr left join iwPOitem AS po
            ON pr.PK_iwPritem = po.FK_iwPRitem JOIN 
            vwReportPurchaseRequest AS prq ON prq.PK_TRXNO = pr.FK_TRXNO JOIN
            iwPRinv pri ON prq.PK_TRXNO = pri.PK_TRXNO 
			WHERE po.FK_TRXNO is null;
     */



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

            $data -> procurement_desc = $request -> procurement_desc;
            $data -> created_at = now();
            $data -> updated_at = now();

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

    public function destroy(Request $request)
    {
        try{

            $data = Procurement::findOrFail($request -> PK_procurement_ID);
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
