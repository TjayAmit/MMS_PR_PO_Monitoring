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
            $table -> increments('PK_procurement_ID')->comment('Primary key of procurement mode')->change();
            $table -> string('procurement_description')->comment('Description of procurement')->change();
            
            $table -> integer('FK_pr_ID') -> unsigned() -> nullable()->comment('Identify to which purchase request this belong')->change();
            $table -> foreign('FK_pr_ID') -> references('PK_pr_ID') -> on('purchase_request') -> onUpdate('cascade');
            $table -> timestamps()->comment('Date and time created and changes applied')->change();
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
