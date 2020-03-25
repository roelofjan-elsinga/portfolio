<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkTable extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('summary', 160);
            $table->text('content');
            $table->string('link');
            $table->integer('order');
            $table->string('image_full');
            $table->string('image_large');
            $table->string('image_small');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('works');
    }
}
