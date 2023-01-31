<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Profile;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        User::truncate();

        User::create([
            'name' => 'mmsadmin',
            'email' => 'mmsadmin@gmail.com',
            'password' => Hash::make('mmsmonitoring@123'),
            'status' => 1
        ]);
    }
}
