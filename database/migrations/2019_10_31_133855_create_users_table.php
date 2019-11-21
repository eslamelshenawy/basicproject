<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone',11);
            $table->string('latitude');
            $table->string('longitude');
            $table->Integer('state_id');
            $table->Integer('city_id');
            $table->string('address');
            $table->integer('day')->nullable();
            $table->time('hours')->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('active')->default('0');
            $table->enum('status', ["pending", "active", "refused", "Blocked"]);
            $table->string('password');
            $table->enum('type', ["admin"=>1, "captain"=>2, "agent"=>3,"employee"=>4]);
            $table->string('image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
