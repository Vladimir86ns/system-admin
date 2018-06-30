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
            $table->decimal('total_amount', 10, 2);
            $table->decimal('income', 10, 2);
            $table->decimal('expense', 10, 2);
            $table->decimal('profit', 10, 2);
            $table->decimal('profit_sharing', 10, 2);
            $table->decimal('investment_collected', 10, 2);
            $table->string('phone_number')->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->integer('investments_admin_id')->unsigned();
            $table->foreign('investments_admin_id')->references('id')->on('investments_admins');
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
