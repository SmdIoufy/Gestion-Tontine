<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('custom_notifications', function (Blueprint $table) {
            $table->id(); // Utilisation d'un entier auto-incrémenté
            $table->string('title');
            $table->text('message');
            $table->string('priority');
            $table->unsignedBigInteger('sender_id');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('custom_notification_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('read')->default(false);
            $table->timestamps();

            $table->foreign('notification_id')->references('id')->on('custom_notifications')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_notification_user');
        Schema::dropIfExists('custom_notifications');
    }
}
