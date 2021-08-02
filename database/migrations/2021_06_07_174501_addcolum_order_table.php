<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcolumOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->date('shipment_date')->nullable()->after('shipped');
            $table->string('slip_number', 16)->nullable()->after('shipment_date');
            $table->string('print_image', 256)->after('image');
            $table->string('name', 64)->after('paper');
            $table->string('company', 64)->nullable()->after('name');
            $table->string('zip', 7)->after('company');
            $table->string('address1', 64)->after('zip');
            $table->string('address2', 64)->nullable()->after('address1');
            $table->string('address3', 64)->nullable()->after('address2');
            $table->string('tel' ,12)->after('address3');
            $table->renameColumn('image', 'org_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
