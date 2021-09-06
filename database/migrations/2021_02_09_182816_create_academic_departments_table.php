<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_class_id');
            $table->string('name',100);
            $table->boolean('status')->default(false);

            $table->foreign('academic_class_id')->references('id')->on('academic_classes')->onDelete('cascade');
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
        Schema::dropIfExists('academic_departments');
    }
}
