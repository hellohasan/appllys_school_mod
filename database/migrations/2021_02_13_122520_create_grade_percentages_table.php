<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradePercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_percentages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_grade_id')->constrained()->onUpdate('cascade');
            $table->string('name');
            $table->integer('min_percentage');
            $table->integer('max_percentage');
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
        Schema::dropIfExists('grade_percentages');
    }
}
