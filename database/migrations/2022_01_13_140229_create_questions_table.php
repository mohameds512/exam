<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answers');
            $table->text('right_answer');
            $table->string('teacher_id');
            $table->integer('qu_deg')->default('1');
            $table->boolean('pending');
            $table->foreignId('unite_id')->references('id')->on('unites')->cascadeOnDelete()->NULL();
            $table->foreignId('subject_id')->references('id')->on('subjects')->cascadeOnDelete()->NULL();
            $table->foreignId('section_id')->references('id')->on('sections')->cascadeOnDelete()->NULL();
            $table->foreignId('class_id')->references('id')->on('classes')->cascadeOnDelete()->NULL();
            $table->foreignId('grade_id')->references('id')->on('grades')->cascadeOnDelete()->NULL();
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
        Schema::dropIfExists('questions');
    }
}
