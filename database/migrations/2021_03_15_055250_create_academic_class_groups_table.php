<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicClassGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_class_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_class_id')->constrained('academic_classes')->cascadeOnDelete();
            $table->foreignId('academic_group_id')->constrained('academic_groups')->cascadeOnDelete();
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
        Schema::dropIfExists('academic_class_groups');
    }
}
