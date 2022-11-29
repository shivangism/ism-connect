<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_log', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['K-12', 'UNIVERSITY']);
            $table->string('classes')->nullable();
            $table
                ->foreignId('school_id')
                ->references('id')
                ->on('school');
            $table
                ->foreignId('course_id')
                ->references('id')
                ->on('courses');
            $table
                ->foreignId('branch_id')
                ->references('id')
                ->on('branch');
            $table
                ->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

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
        Schema::dropIfExists('education_log');
    }
}
