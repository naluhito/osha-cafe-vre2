<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnToOrdersTable extends Migration
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
            $table->dropColumn('company');
            $table->dropColumn('frame');
            $table->dropColumn('h');
            $table->dropColumn('org_image');
            $table->dropColumn('paper');
            $table->dropColumn('print_image');
            $table->dropColumn('slip_number');
            $table->dropColumn('w');
            $table->dropColumn('x');
            $table->dropColumn('y');
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
