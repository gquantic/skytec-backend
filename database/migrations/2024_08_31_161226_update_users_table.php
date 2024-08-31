<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('description')->after('company')->nullable()->comment('Описание пользователя');
            $table->date('last_check')->after('remember_token')->nullable()->comment('Последняя проверка существования в таблице');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('last_check');
        });
    }
};
