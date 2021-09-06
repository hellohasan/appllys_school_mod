<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDepartmentYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_department_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_department_id')->constrained()->cascadeOnDelete();;
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();;
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
        Schema::dropIfExists('academic_department_years');
    }
}
