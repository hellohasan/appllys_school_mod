<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectAssignsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('subject_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('custom')->nullable();
            $table->foreignId('session_id')->constrained('academic_sessions');
            $table->foreignId('academic_class_id')->constrained('academic_classes');
            $table->tinyInteger('type')->default(0);
            $table->foreignId('academic_section_id')->nullable()->constrained('academic_sections');
            $table->foreignId('academic_group_id')->nullable()->constrained('academic_groups');
            $table->foreignId('academic_group_section_id')->nullable()->constrained('academic_sections');
            $table->foreignId('academic_department_id')->nullable()->constrained('academic_departments');
            $table->foreignId('academic_year_id')->nullable()->constrained('academic_years');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('subject_assigns');
    }
}
