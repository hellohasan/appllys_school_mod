<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('bill_package_id')->nullable()->constrained()->cascadeOnDelete();
            $table->float('total')->default(0);
            $table->float('discount')->default(0);
            $table->float('pay')->default(0);
            $table->integer('paid_by')->default(0);
            $table->integer('receive_by')->default(0);
            $table->boolean('isPaid')->default(0);
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
        Schema::dropIfExists('bill_students');
    }
}
