<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
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
            $table->integer('user_id');
            $table->string('order_id');
            $table->date('rent_date');
            $table->timeTz('rent_time');
            $table->date('return_date')->nullable();
            $table->timeTz('return_time')->nullable();
            $table->string('department');
            $table->string('borrow_name');
            $table->string('borrow_company');
            $table->string('borrow_role');
            $table->string('borrow_id');
            $table->string('borrow_tel');
            $table->string('borrow_where');
            $table->string('borrow_airline');
            $table->string('borrow_flight');
            $table->boolean('borrow_status')->default(0);

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
