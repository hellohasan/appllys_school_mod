<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnlineUrlToAcademicSubjectTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('academic_subjects', function (Blueprint $table) {
            $table->text('online_url')->nullable()->before('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('academic_subjects', function (Blueprint $table) {
            $table->dropColumn('online_url');
        });
    }
}
