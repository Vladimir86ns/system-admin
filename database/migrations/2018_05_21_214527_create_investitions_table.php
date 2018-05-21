<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('total_investition');
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->boolean('closed');
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
        Schema::dropIfExists('investitions');
    }
}
