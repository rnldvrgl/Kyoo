<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('login_id')->constrained('account_logins')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->unsignedInteger('duration')->default(0);
            $table->dateTime('paused_at')->nullable();
            $table->unsignedInteger('paused_duration')->default(0);
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
        Schema::dropIfExists('work_sessions');
    }
};
