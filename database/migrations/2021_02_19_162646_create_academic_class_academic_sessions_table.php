<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicClassAcademicSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_class_academic_session', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('academic_class_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->float('admission_fee')->nullable();

            $table->foreign('academic_class_id')->references('id')->on('academic_classes')
                ->onDelete('cascade');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_class_academic_sessions');
    }
}
