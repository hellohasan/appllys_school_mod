<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAcademicExamLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_exam_logs', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('academic_data_subject_id');
            $table->float('theory')->default(0)->after('status');
            $table->float('practical')->default(0)->after('theory');
            $table->text('comment')->nullable()->after('updated_by');
            $table->foreignId('grade_percentage_id')->nullable()->constrained()->after('is_optional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_exam_logs', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('theory');
            $table->dropColumn('practical');
            $table->dropColumn('comment');
            $table->dropColumn('grade_percentage_id');
        });
    }
}
