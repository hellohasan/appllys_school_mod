<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upazila_id');
            $table->string('union_name',191);
            $table->string('post_office',191);
            $table->string('village',191);
            $table->boolean('address_type')->default(false);
            $table->integer('present_division_id')->nullable();
            $table->integer('present_district_id')->nullable();
            $table->integer('present_upazila_id')->nullable();
            $table->string('present_union_name',191)->nullable();
            $table->string('present_post_office',191)->nullable();
            $table->string('present_village',191)->nullable();
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
        Schema::dropIfExists('user_addresses');
    }
}
