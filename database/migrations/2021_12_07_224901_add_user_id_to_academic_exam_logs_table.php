<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToAcademicExamLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_exam_logs', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('academic_exam_class_id');
            $table->foreignId('academic_subject_id')->nullable()->after('academic_exam_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_exam_logs', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('academic_subject_id');
        });
    }
}
