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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('details_id')->constrained('account_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('login_id')->constrained('account_logins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('role_id')->constrained('account_roles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('accounts');
    }
};
