<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnToOrdersTable extends Migration
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
            $table->dropColumn('name');
            $table->string('name1', 64)->after('address3');
            $table->string('name2', 64)->after('name1');
            $table->string('name3', 64)->after('name2');
            $table->string('name4', 64)->after('name3');
            $table->string('pref', 64)->after('zip');
            $table->string('mail' ,256)->after('tel');            
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
