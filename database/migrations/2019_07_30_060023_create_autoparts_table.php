<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutopartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoparts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('autopart_category');
            $table->smallInteger('quantity');
            $table->smallInteger('state');
            $table->double('car_price_reduction_on_sale');
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
        Schema::dropIfExists('autoparts');
    }
}
