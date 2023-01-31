<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $table = 'procurement_record';

    protected $primaryKey = 'PK_procurement_ID';

    protected $fillable = [
        'procurement_description',
        'created_at',
        'updated_at'
    ];

    protected $timestamp = TRUE;
}
