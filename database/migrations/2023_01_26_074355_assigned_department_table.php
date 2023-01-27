<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_department',function(Blueprint $table){
            $table -> increments('PK_assigned_dept_ID');
            $table -> unsignedBigInteger('FK_user_ID') ;
            $table -> foreign('FK_user_ID') -> references("id") -> on('users');
            $table -> integer('FK_department_ID') -> unsigned() -> nullable();
            $table -> foreign('FK_department_ID') -> references('PK_department_ID') -> on('department') -> onUpdate('cascade');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropExist('assigned_department');
    }
};
