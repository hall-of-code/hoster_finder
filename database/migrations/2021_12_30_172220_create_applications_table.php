<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('app_name')->nullable();
            $table->string('app_token')->nullable();
            $table->integer('rate_limit')->default(30);
            $table->string('app_perms')->nullable();
            $table->string('app_icon')->default(asset('res/images/logo.png'));
            $table->integer('app_status')->default(1);
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
        Schema::dropIfExists('applications');
    }
}
