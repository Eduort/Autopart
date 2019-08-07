<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('brand_id')->unsigned()->index()->nullable();
            $table->foreign('brand_id')->references('id')
                ->on('brands')->onDelete('cascade');
            $table->string('model');
            $table->smallInteger('year');
            $table->string('seller');
            $table->string('phone');
            $table->text('description');
            $table->double('price');
            $table->boolean('sold');
            $table->integer('productable_id')->nullable();
            $table->string('productable_type')->nullable();
            $table->boolean('approved')->default(false);
            $table->integer('published_by');
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
        Schema::dropIfExists('products');
    }
}
