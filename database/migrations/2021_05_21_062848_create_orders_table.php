<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('payment_kind');
            $table->boolean('paid')->default(false);
            $table->integer('amount');
            $table->integer('tax');
            $table->integer('shipping');
            $table->string('image',	256);
            $table->integer('x');
            $table->integer('y');
            $table->integer('w');
            $table->integer('h');
            $table->string('frame', 256)->nullable();;
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
        Schema::dropIfExists('orders');
    }
}
