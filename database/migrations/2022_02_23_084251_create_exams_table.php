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
            $table->foreignId('unite_id')->nullable()->references('id')->on('unites')->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->references('id')->on('subjects')->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->references('id')->on('sections')->cascadeOnDelete();
            $table->foreignId('class_id')->nullable()->references('id')->on('classes')->cascadeOnDelete();
            $table->foreignId('grade_id')->nullable()->references('id')->on('grades')->cascadeOnDelete();

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
