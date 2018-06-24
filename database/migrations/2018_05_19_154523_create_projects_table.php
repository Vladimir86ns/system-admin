<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->decimal('total_amount');
            $table->decimal('income');
            $table->decimal('expense');
            $table->decimal('profit');
            $table->decimal('profit_sharing');
            $table->decimal('investment_collected');
            $table->string('phone_number')->nullable();
            $table->integer('investment_id')->unsigned();
            $table->foreign('investment_id')->references('id')->on('investments');
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
        Schema::dropIfExists('projects');
    }
}
