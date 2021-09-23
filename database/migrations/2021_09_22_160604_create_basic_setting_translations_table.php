<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_setting_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basic_setting_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->text('text');

            $table->unique(['basic_setting_id','locale']);
            $table->foreign('basic_setting_id')->references('id')->on('basic_settings')->onDelete('cascade');

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
        Schema::dropIfExists('basic_setting_translations');
    }
}
