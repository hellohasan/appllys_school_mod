<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicLevelsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('academic_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_class_id')->constrained();
            $table->tinyInteger('type')->default(0);
            $table->bigInteger('level_one_id')->index();
            $table->bigInteger('level_two_id')->index()->nullable();
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
        Schema::dropIfExists('academic_levels');
    }
}
