<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    
    protected $table = 'items';

    protected $primaryKey = "PK_item_ID";

    protected $fillable = [
        'description',
        'unit',
        'price',
        'total',
    ];

    protected $timestamp = TRUE;
}
