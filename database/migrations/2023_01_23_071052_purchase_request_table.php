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
            $table -> string("pr_no") -> nullable();
            $table -> string('rcc') -> nullable();
            $table -> string('fund_cluster') -> nullable();
            $table -> string('pr_Prxno');
            $table -> longText('pr_remarks') -> nullable();
            $table -> date('pr_date');
            $table -> string('procurement_description') ->  nullable();
            $table -> integer('FK_department_ID') -> unsigned()-> nullable();
            $table -> date("sol_no") -> nullable();
            $table -> date("procurement_date") -> nullable();
            $table -> date("posting_date") -> nullable();
            $table -> date("opening_date") -> nullable();
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
        Schema::dropExist('purchase_request');
    }
};
