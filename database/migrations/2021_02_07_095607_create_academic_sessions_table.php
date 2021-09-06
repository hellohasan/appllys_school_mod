<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->year('start_year');
            $table->year('end_year');
            $table->string('duration',20);
            $table->boolean('status')->default(false);
            $table->boolean('isCurrent')->default(false);
            $table->string('off_day')->default('Friday');
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
        Schema::dropIfExists('academic_sessions');
    }
}
