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
            $table -> increment('PK_pr_ID');
            $table -> string('pr_Prxno');
            $table -> string('pr_no');
            $table -> string('pr_department');
            $table -> string('pr_remarks');
            $table -> date('pr_reg_date');
            
            $table -> increment('FK_procurement_ID') -> unsigned() -> nullable();
            $table -> foreign('FK_procurement_ID') -> references('PK_procurement_ID') -> on('procurement_status') -> onUpdate('cascade');
            $table -> timestamp();
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
