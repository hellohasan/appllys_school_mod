<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAssignIsRoutineToAcademicExamClassesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_exam_classes', function (Blueprint $table) {
            $table->boolean('is_assigned')->default(false);
            $table->boolean('is_routine')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_exam_classes', function (Blueprint $table) {
            $table->dropColumn('is_assigned');
            $table->dropColumn('is_routine');
        });
    }
}
