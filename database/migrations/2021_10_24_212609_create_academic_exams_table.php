<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicExamsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('academic_exams', function (Blueprint $table) {
            $table->id();
            $table->string('custom')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('academic_session_id')->constrained('academic_sessions');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('academic_exams');
    }
}
