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
            $table -> increments('PK_pr_ID');
            $table -> string('pr_Prxno');
            $table -> longText('pr_remarks') -> nullable();
            $table -> date('pr_date');
            
            $table -> integer('FK_department_ID') -> unsigned() -> nullable();
            $table -> foreign('FK_department_ID') -> references('PK_department_ID') -> on('department') -> onUpdate('cascade');

            $table -> integer('FK_procurement_ID') -> unsigned() -> nullable();
            $table -> foreign('FK_procurement_ID') -> references('PK_procurement_ID') -> on('procurement_status') -> onUpdate('cascade');
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
        Schema::dropExist('purchase_request');
    }
};
