<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicExamLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('academic_exam_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_exam_id')->constrained('academic_exams');
            $table->foreignId('academic_exam_class_id')->constrained('academic_exam_classes');
            $table->foreignId('academic_data_subject_id')->constrained('academic_data_subjects');
            $table->float('total_gain')->default(0);
            $table->boolean('is_optional')->default(false);
            $table->foreignId('academic_grade_id')->nullable()->constrained('academic_grades');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('academic_exam_logs');
    }
}
