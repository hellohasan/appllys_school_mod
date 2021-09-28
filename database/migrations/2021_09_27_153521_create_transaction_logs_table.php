<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->morphs('logable');
            $table->string('reason');
            $table->foreignId('account_id')->constrained('accounts');
            $table->float('before_amount')->default(0);
            $table->float('amount')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->float('after_amount')->default(0);
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
        Schema::dropIfExists('transaction_logs');
    }
}
