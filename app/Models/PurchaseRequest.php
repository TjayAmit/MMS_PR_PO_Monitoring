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
        'pr_Prxno',
        'pr_no',
        'pr_department',
        'pr_remarks',
        'pr_reg_date'
    ];

    protected $timestamp = TRUE;
}
