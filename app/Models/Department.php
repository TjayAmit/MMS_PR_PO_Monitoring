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
        'dept_name',
        'dept_location',
        'dept_head',
        'created_at',
        'update_at',
    ];

    protected $timestamp = TRUE;
}
