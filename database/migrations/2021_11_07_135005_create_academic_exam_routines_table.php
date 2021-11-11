<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicExamRoutinesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('academic_exam_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_exam_id')->constrained();
            $table->foreignId('academic_subject_id')->constrained('academic_subjects');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('academic_exam_routines');
    }
}
