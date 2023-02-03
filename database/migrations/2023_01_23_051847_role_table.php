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
        Schema::create('role', function(Blueprint $table){
            $table -> increments('PK_role_ID')->comment('Primary key for type of role in the system')->change();;
            $table -> string('name')->comment('Description of role')->change();
            $table->timestamps()->comment('Time and date created and changes applied')->change();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropExist('role');
    }
};
