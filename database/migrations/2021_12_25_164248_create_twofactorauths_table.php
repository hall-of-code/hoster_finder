<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwofactorauthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twofactorauths', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tan_code')->nullable();
            $table->integer('factor_mode')->default(0);
            $table->string('auth_time')->nullable();
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
        Schema::dropIfExists('twofactorauths');
    }
}
