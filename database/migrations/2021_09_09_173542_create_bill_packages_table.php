<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_packages', function (Blueprint $table) {
            $table->id();
            $table->string('custom');
            $table->foreignId('academic_class_id')->constrained()->onUpdate('cascade');
            $table->tinyInteger('academic_class_type')->default(0);
            $table->foreignId('academic_group_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('bill_type')->nullable();
            $table->longText('items')->nullable();
            $table->float('total')->default(0);
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
        Schema::dropIfExists('bill_packages');
    }
}
