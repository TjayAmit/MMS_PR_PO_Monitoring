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
        Schema::create('purchase_request', function(Blueprint $table){
            $table -> increments('PK_pr_ID')->comment('Primary key of purchase request within the system')->change();
            $table -> string('pr_Prxno')->comment('Primary key of purchase request within BizzBox system')->change();
            $table -> longText('pr_remarks') -> nullable()->comment('Remarks or message')->change();
            $table -> date('pr_date')->comment('Date of purchase reques with in the BizzBox system')->change();
            
            $table -> integer('FK_department_ID') -> unsigned() -> nullable()->comment('Identify in which department the purchase request belongs')->change();
            $table -> foreign('FK_department_ID') -> references('PK_department_ID') -> on('department') -> onUpdate('cascade');
            $table -> timestamps()->comment('Date and time purchase request is registered in the system')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropExist('purchase_request');
    }
};
