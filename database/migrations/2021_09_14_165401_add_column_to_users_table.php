<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('name1', 64);
            $table->string('name2', 64);
            $table->string('name3', 64);
            $table->string('name4', 64);
            $table->string('zip', 8);
            $table->string('pref', 64);
            $table->string('address1', 64);
            $table->string('address2', 64);
            $table->string('address3', 64);
            $table->string('tel', 14);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
