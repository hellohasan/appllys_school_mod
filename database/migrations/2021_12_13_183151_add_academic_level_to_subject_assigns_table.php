<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcademicLevelToSubjectAssignsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('subject_assigns', function (Blueprint $table) {
            $table->foreignId('academic_level_id')->nullable()->constrained()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('subject_assigns', function (Blueprint $table) {
            $table->dropColumn('academic_level_id');
        });
    }
}
