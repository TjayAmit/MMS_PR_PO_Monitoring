<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $table = 'purchase_request';

    protected $primaryKey = 'PK_pr_ID';

    protected $fillable = [
        'pr_no',
        'rcc',
        'fund_cluster',
        'pr_Prxno',
        'pr_department',
        'pr_remarks',
        'sol_no',
        'procurement_date',
        'posting_date',
        'opening_date',
        'pr_date',
    ];

    protected $timestamp = TRUE;
}
