<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcademicLevelIdToAcademicDataTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_data', function (Blueprint $table) {
            $table->foreignId('academic_level_id')->nullable()->constrained()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_data', function (Blueprint $table) {
            $table->dropColumn('academic_level_id');
        });
    }
}
