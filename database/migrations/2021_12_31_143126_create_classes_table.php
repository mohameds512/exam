<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{


    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->foreignId('grade_id')->references('id')->on('grades')->cascadeOnDelete();
            $table->string('academic_year');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
