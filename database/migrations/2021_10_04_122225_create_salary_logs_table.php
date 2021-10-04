<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('salary_logs', function (Blueprint $table) {
            $table->id();
            $table->string('custom');
            $table->foreignId('salary_id')->constrained('salaries');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('salary_scale_id')->constrained('salary_scales');
            $table->foreignId('account_id')->constrained('accounts');
            $table->float('amount');
            $table->boolean('is_attempt')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('salary_logs');
    }
}
