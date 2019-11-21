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
            $table->bigIncrements('id');
            $table->bigInteger('agent_id')->unsigned();
            $table->string('address');
            $table->Integer('state_id');
            $table->Integer('city_id');
            $table->string('end_lat');
            $table->string('end_lang');
            $table->bigInteger('agentaddress_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agentaddress_id')->references('id')->on('branches')->onDelete('cascade');
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
