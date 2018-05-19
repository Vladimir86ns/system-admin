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
            $table->increments('id');
            $table->unsignedInteger('product_categories_id');
            $table->unsignedInteger('project_id');
            $table->string('name', 50);
            $table->string('size', 50);
            $table->decimal('cost');
            $table->decimal('price');
            $table->string('picture');
            $table->integer('time_to_prepare');
            $table->foreign('product_categories_id')->references('id')->on('product_categories');
            $table->foreign('project_id')->references('id')->on('projects');
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
