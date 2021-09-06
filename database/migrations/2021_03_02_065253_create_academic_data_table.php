<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('custom');
            $table->foreignId('academic_session_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_class_id')->nullable()->constrained()->cascadeOnDelete();
            $table->tinyInteger('type')->default(0);
            $table->foreignId('academic_group_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_section_id')->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('academic_data');
    }
}
