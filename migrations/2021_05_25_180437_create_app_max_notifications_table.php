<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMaxNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('app_max_notifications', function (Blueprint $table) {
            $table->id();
			$table->string('environment')->nullable();
			$table->string('event')->nullable();
			$table->string('status')->nullable();
			$table->json('data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_max_notifications');
    }
}
