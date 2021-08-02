<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('token', 32)->nullable();
            $table->string('mail', 256);
            $table->string('password', 128);
            $table->string('name', 64);
            $table->string('zip',	7);
            $table->string('address1',	64);
            $table->string('address2',	64)->nullable();
            $table->string('address3',	64)->nullable();
            $table->string('tel' ,12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
