<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcademicLevelToTeacherSubjectsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('teacher_subjects', function (Blueprint $table) {
            $table->foreignId('academic_level_id')->nullable()->after('subject_assign_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('teacher_subjects', function (Blueprint $table) {
            $table->dropColumn('academic_level_id');
        });
    }
}
