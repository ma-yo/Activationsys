<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivatedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activated_users', function (Blueprint $table) {
            $table->string('serialid');
            $table->string('name');
            $table->string('email');
            $table->string('biosid')->nullable();
            $table->string('ban')->nullable();
            $table->timestamps();
            $table->primary(['serialid'],'activated_users_pkey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activated_users');
    }
}
