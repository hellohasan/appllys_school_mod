<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceTransfersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('balance_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('custom')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('from_account_id')->constrained('accounts');
            $table->float('amount');
            $table->float('from_charge')->default(0);
            $table->float('from_total');

            $table->foreignId('to_account_id')->constrained('accounts');
            $table->float('to_charge')->default(0);
            $table->float('to_total');
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
        Schema::dropIfExists('balance_transfers');
    }
}
