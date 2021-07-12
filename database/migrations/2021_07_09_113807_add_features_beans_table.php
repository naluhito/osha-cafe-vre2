<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturesBeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beans', function (Blueprint $table) {
            //
            $table->string('features1', 64)->nullable()->after('district');
            $table->string('features2', 64)->nullable()->after('features1');
            $table->string('features3', 64)->nullable()->after('features2');
            $table->dropColumn('district');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beans', function (Blueprint $table) {
            //
        });
    }
}
