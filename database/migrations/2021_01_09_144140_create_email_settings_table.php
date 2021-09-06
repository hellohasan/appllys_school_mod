<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name',100);
            $table->string('sender_email',100);
            $table->string('mail_driver',10);
            $table->string('smtp_host',100);
            $table->string('smtp_port',10);
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('smtp_enc');
            $table->binary('email_template')->nullable();
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
        Schema::dropIfExists('email_settings');
    }
}
