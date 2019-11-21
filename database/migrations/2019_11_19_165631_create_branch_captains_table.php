<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchCaptainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_captains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('captain_id')->unsigned();
            $table->softDeletes();
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('captain_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('branch_captains');
    }
}
