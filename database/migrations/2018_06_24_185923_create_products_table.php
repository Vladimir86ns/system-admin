<?php

namespace database\migrations;

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
            $table->integer('product_categories_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('name', 50);
            $table->string('size', 50);
            $table->decimal('cost', 10, 2);
            $table->decimal('price', 10, 2);
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
