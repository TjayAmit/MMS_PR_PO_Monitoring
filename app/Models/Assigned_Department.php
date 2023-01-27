<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigned_Department extends Model
{
    use HasFactory;

    protected $table = 'assigned_department';

    protected $primaryKey = 'PK_assigned_dept_ID';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];

    protected $timestamp = TRUE;
}
