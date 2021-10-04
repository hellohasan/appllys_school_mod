<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->float('total');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('salaries');
    }
}
