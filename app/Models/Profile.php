<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $primaryKey = 'PK_profile_ID';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name'
    ];

    protected $timestamp = TRUE;
}
