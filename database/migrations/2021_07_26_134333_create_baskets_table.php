<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->string('photo_name', 256);
            $table->string('photo_type', 128);
            $table->longText('photo_uri');
            $table->string('frame', 128);
            $table->float('image_width', 6, 4);
            $table->float('image_height', 6, 4);
            $table->float('image_diffx', 6, 4);
            $table->float('image_diffy', 6, 4);
            $table->float('image_scale', 6, 4);
            $table->float('image_frameWidth', 6, 4);
            $table->float('image_frameHeight', 6, 4);
            $table->integer('bean_id');
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
        Schema::dropIfExists('baskets');
    }
}
