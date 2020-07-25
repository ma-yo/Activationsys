<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettinginfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_infos', function (Blueprint $table) {
            $table->string('settingid');
            $table->string('value1');
            $table->string('value2')->nullable();
            $table->string('value3')->nullable();
            $table->string('value4')->nullable();
            $table->string('value5')->nullable();
            $table->string('value6')->nullable();
            $table->string('value7')->nullable();
            $table->string('value8')->nullable();
            $table->string('value9')->nullable();
            $table->string('value10')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->primary(['settingid'],'setting_infos_pkey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_infos');
    }
}
