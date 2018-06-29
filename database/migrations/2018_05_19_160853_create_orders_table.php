<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->string('list_of_orders_ids');
            $table->boolean('to_deliver');
            $table->string('time_to_finish');
            $table->string('city', 50);
            $table->string('address', 100);
            $table->integer('flat_number');
            $table->integer('delivery_boy_id')->unsigned();
            $table->dateTime('time_delivered');
            $table->foreign('customer_id')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
