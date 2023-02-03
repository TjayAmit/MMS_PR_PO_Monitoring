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
        Schema::create('department', function (Blueprint $table) {
            $table->increments('PK_department_ID')->comment('Primary key for department')->change();
            $table->integer('dept_PK_msc_warehouse')->comment('Warehouse Primary key that is use in BizzBox')->change();
            $table->string('dept_name')->comment('Name of the department will be use for creating account, PR and PO')->change();
            $table->string('dept_shortname') -> nullable() ->comment('Shortname for the department name')->change();
            $table->timestamps()->comment('Time and date created and changes apply')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department');
    }
};
