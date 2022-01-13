<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcademicLevelIdToAcademicExamLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_exam_logs', function (Blueprint $table) {
            $table->foreignId('academic_level_id')->nullable()->after('academic_data_subject_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_exam_logs', function (Blueprint $table) {
            $table->dropColumn('academic_level_id');
        });
    }
}
