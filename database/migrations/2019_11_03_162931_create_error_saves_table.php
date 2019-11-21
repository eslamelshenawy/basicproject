<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorSavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_saves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_name');
            $table->string('function_name');
            $table->text('error_message');
            $table->boolean('Is_mobile_Web');
            $table->softDeletes();

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
        Schema::dropIfExists('error_saves');
    }
}
