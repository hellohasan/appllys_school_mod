<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_class_id')->constrained()->onUpdate('cascade');
            $table->tinyInteger('academic_class_type')->default(0);
            $table->foreignId('academic_group_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_section_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name',191);
            $table->string('code',50);
            $table->boolean('mark_type')->default(0);
            $table->float('theory')->default(0);
            $table->float('practical')->default(0);
            $table->float('full_mark')->default(0);
            $table->boolean('subject_type')->default(0);
            $table->float('point')->default(0);
            $table->float('total_point')->default(0);
            $table->float('optional_point')->default(0);
            $table->boolean('religion_type')->default(0);
            $table->foreignId('religion_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('academic_subjects');
    }
}
