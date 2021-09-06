<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('type')->default(0);
            $table->foreignId('academic_group_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('designation_id')->constrained('designations')->cascadeOnDelete();
            $table->foreignId('religion_id')->constrained('religions')->cascadeOnDelete();
            $table->foreignId('salary_scale')->constrained('salary_scales')->cascadeOnDelete();
            $table->string('blood',30);
            $table->date('join_date');
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
        Schema::dropIfExists('teachers');
    }
}
