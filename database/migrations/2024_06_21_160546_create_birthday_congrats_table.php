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
        Schema::create('birthday_congrats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('to_id')->constrained('users');
            $table->longText('message')->nullable();
            $table->string('surprise')->default('none');
            $table->boolean('anonymous')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birthday_congrats');
    }
};
