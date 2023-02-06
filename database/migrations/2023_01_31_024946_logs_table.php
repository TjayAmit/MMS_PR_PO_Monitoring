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
        Schema::create('logs',function(Blueprint $table){
            $table -> increments('PK_log_ID');
            $table -> string('table');
            $table -> integer('PK_ID')-> nullable();
            $table -> unsignedBigInteger('FK_user_ID') -> unsigned()-> nullable();
            $table -> foreign('FK_user_ID') -> references('id') -> on('users');
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
        Schema::dropExist('logs');
    }
};
