<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnToBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baskets', function (Blueprint $table) {
            //
            $table->float('image_width', 11, 4)->change();
            $table->float('image_height', 11, 4)->change();
            $table->float('image_diffx', 11, 4)->change();
            $table->float('image_diffy', 11, 4)->change();
            $table->float('image_scale', 11, 4)->change();
            $table->float('image_frameWidth', 6, 4)->change();
            $table->float('image_frameHeight', 6, 4)->change();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('baskets', function (Blueprint $table) {
            //
        });
    }
}
