<?php

namespace database\migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentsAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('total_investition', 10, 2);
            $table->decimal('collected_to_date', 10, 2);
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->string('status');
            $table->boolean('closed')->default(false);
            $table->boolean('on_production')->default(false);
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
        Schema::dropIfExists('investments_admins');
    }
}
