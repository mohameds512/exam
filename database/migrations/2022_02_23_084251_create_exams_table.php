<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('notes');
            $table->string('duration');
            $table->boolean('status')->default('1');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->foreignId('teacher_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('unite_id')->references('id')->on('unites')->cascadeOnDelete()->NULL();
            $table->foreignId('subject_id')->references('id')->on('subjects')->cascadeOnDelete()->NULL();
            $table->foreignId('section_id')->references('id')->on('sections')->cascadeOnDelete()->NULL();
            $table->foreignId('class_id')->references('id')->on('classes')->cascadeOnDelete()->NULL();
            $table->foreignId('grade_id')->references('id')->on('grades')->cascadeOnDelete()->NULL();

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
        Schema::dropIfExists('exams');
    }
}
