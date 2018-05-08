<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('stock')->unique();
            $table->integer('from');
            $table->integer('to');
            $table->integer('stoploss');
            $table->integer('target');
            $table->date('expire');
            $table->string('risk');
            $table->string('type');
            $table->text('details');
            $table->string('image');
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
        Schema::dropIfExists('recos');
    }
}
