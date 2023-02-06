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
        Schema::create('procurement_record',function(Blueprint $table){
            $table -> increments('PK_procurement_ID');
            $table -> string('procurement_description');    
            $table -> integer('FK_pr_ID') -> unsigned() -> nullable();
            $table -> foreign('FK_pr_ID') -> references('PK_pr_ID') -> on('purchase_request') -> onUpdate('cascade');
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
        Schema::dropExist('procurement_record');
    }
};
