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
        Schema::create('items', function(Blueprint $table){
            $table -> increments('PK_item_ID');
            $table -> string('PK_iwItems');
            $table -> text('description');
            $table -> integer('quantity');
            $table -> string('unit'); 
            $table -> double('price',15,3);
            $table -> string('procurement_remarks') -> nullable();
            $table -> integer('FK_pr_ID') -> unsigned() -> nullable();
            $table -> foreign('FK_pr_ID') -> references('PK_pr_ID') -> on('purchase_request');
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
        Schema::dropExist('items');
    }
};
