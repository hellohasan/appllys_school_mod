<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectAssignListsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('subject_assign_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_assign_id')->constrained('subject_assigns');
            $table->foreignId('academic_subject_id')->constrained('academic_subjects');
            $table->foreignId('day_id')->constrained('days');
            $table->foreignId('teacher_id')->nullable()->constrained('users');
            $table->foreignId('period_id')->nullable()->constrained('class_periods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('subject_assign_lists');
    }
}
