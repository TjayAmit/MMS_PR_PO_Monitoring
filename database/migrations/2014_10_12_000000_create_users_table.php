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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Primary key for the user account')->change();
            $table->string('name')->comment('Username of account use in signing in')->change();
            $table->string('email')->unique()->comment('Email Address of user for recovery of account')->change();
            $table->timestamp('email_verified_at')->nullable()->comment('Specify if the account email is verified')->change();
            $table->string('profile')->nullable()->comment('Picture URL of the user can be anything must be an image')->change();
            $table->string('password')->comment('Password of the account')->change();
            $table->integer('status')->default("0")->comment('Account status if pending, approved or dissabled.')->change();
            $table->rememberToken()->comment('Use for account recovery as token identity on client side')->change();
            $table->timestamps()->comment('The time account created or changes apply')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
