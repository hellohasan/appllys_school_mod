<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcademicSubjectLevelIdToAcademicExamRoutinesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_exam_routines', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_subject_level_id')->index()->after('academic_exam_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_exam_routines', function (Blueprint $table) {
            $table->dropColumn('academic_subject_level_id');
        });
    }
}
