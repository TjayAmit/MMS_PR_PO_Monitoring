<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Profile;

class ProfileTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Profile::truncate();

        

        Profile::create([
            'first_name' => "Tristan jay",
            'middle_name' => "Loquillano",
            'last_name' => "Amit",
            'FK_role_ID' => 1,
            'FK_user_ID' => 1,
            'FK_department_ID' => 1
        ]);
    }
}
