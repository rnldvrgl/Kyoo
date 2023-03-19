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
        Schema::create('queue_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->string('ticket_number');
            $table->string('student_name');
            $table->string('student_department');
            $table->string('student_course');
            $table->string('status');
            $table->string('clearance_status')->nullable();
            $table->integer('waiting_time')->nullable();
            $table->integer('service_time')->nullable();
            $table->dateTime('called_at')->nullable();
            $table->dateTime('served_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('notes')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('queue_tickets');
    }
};
