<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $primaryKey = "PK_log_ID";

    protected $fillable = [
        'table_name',
        'task',
        'PK_ID',
        'created_at',
    ];

    protected $timestamp = TRUE;
}
