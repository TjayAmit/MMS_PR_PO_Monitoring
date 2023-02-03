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
            $table->increments('PK_profile_ID')->comment('Primary key for the user information')->change();
            $table->string('first_name')->comment('First name of the user')->change();;
            $table->string('middle_name')->comment('Middle name of the user')->change();;
            $table->string('last_name')->comment('Last name of the user')->change();
            //Foreign key role, user must have one role will be use in UI display
            $table->integer('FK_role_ID')->unsigned()->comment('Foreign key to identify of what role the account has')->change();
            $table->foreign('FK_role_ID')->references('PK_role_ID')->on('role')->onUpdate('cascade');
            //Foreign key user, profile must assign to one user account unique account
            $table->unsignedBigInteger('FK_user_ID')->unsigned()->comment('Identify which user account it belongs')->change();
            $table->foreign('FK_user_ID')->references('id')->on('users')->onUpdate('cascade');
            //Foreign key department, user must belong to one deparment
            $table->integer('FK_department_ID')->unsigned()->nullable()->comment('Identify in which department the user is working')->change();
            $table->foreign('FK_department_ID')->references('PK_department_ID')->on('department')->onUpdate('cascade');
            $table->timestamps()->comment('Date and Time created and changes applied')->change();
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
