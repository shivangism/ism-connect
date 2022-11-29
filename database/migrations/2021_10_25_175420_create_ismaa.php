<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsmaa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ismaa', function (Blueprint $table) {
            $table->id();

            $table->string('chapter_name');
            $table->string('head_name');
            $table->string('place');
            $table->string('address');
            $table->string('mobile');
            $table->string('email');
            $table->string('website');

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
        Schema::dropIfExists('ismaa');
    }
}
