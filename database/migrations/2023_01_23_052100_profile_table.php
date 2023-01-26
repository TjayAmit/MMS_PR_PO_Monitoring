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
        Schema::create('profile',function(Blueprint $table){
            $table->increments('PK_profile_ID');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            //Foreign key role, user must have one role will be use in UI display
            $table->integer('FK_role_ID')->unsigned();
            $table->foreign('FK_role_ID')->references('PK_role_ID')->on('role')->onUpdate('cascade');
            //Foreign key user, profile must assign to one user account unique account
            $table->unsignedBigInteger('FK_user_ID')->unsigned();
            $table->foreign('FK_user_ID')->references('id')->on('users')->onUpdate('cascade');
            //Foreign key department, user must belong to one deparment
            $table->integer('FK_department_ID')->unsigned()->nullable();
            $table->foreign('FK_department_ID')->references('PK_department_ID')->on('department')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropExist('profile');
    }
};
