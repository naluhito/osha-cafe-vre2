<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DecimalToFloatBasketsTable extends Migration
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
            $table->float('image_width', 6, 4)->change();
            $table->float('image_height', 6, 4)->change();
            $table->float('image_diffx', 6, 4)->change();
            $table->float('image_diffy', 6, 4)->change();
            $table->float('image_scale', 6, 4)->change();
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
