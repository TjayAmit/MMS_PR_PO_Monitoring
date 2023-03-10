<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    protected $table = 'department';

    protected $primaryKey = 'PK_department_ID';

    protected $fillable = [
        'dept_PK_msc_warehouse',
        'dept_name',
        'dept_shortname',
        'created_at',
        'update_at',
    ];

    protected $timestamp = TRUE;
}
