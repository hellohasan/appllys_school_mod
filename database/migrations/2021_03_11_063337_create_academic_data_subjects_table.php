<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDataSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_data_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_data_id')->constrained('academic_data')->cascadeOnDelete();
            $table->foreignId('academic_subject_id')->constrained('academic_subjects')->cascadeOnDelete();
            $table->boolean('isOptional')->default(false);
            $table->float('total_gain')->nullable();
            $table->integer('academic_grade_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_data_subjects');
    }
}
