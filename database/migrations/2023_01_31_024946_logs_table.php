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
            $table -> increments('PK_log_ID')->comment('Primary key for history action logs in the system')->change();;
            $table -> string('table')->comment('Indicate what table an action has perform')->change();

            $table -> integer('PK_ID') -> unsigned() -> nullable()->comment('ID of new data this are primary keys in any table')->change();

            $table -> unsignedBigInteger('FK_user_ID') -> unsigned() -> nullable()->comment('Foreign key to indicate who perform the action')->change();;
            $table -> foreign('FK_user_ID') -> references('id') -> on('users');

            $table -> timestamps()->comment('Date and Time the action happen')->change();;
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
