<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicExamClassesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('academic_exam_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_exam_id')->constrained('academic_exams');
            $table->foreignId('academic_class_id')->constrained('academic_classes');
            $table->tinyInteger('type')->nullable();
            $table->foreignId('academic_section_id')->nullable()->constrained('academic_sections');
            $table->foreignId('academic_group_id')->nullable()->constrained('academic_groups');
            $table->foreignId('group_section_id')->nullable()->constrained('academic_sections');
            $table->foreignId('academic_department_id')->nullable()->constrained('academic_departments');
            $table->foreignId('department_year_id')->nullable()->constrained('academic_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('academic_exam_classes');
    }
}
