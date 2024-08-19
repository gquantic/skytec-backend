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
        Schema::table('documents', function (Blueprint $table) {
            $table->string('company');
        });

        Schema::table('vacation_application_documents', function (Blueprint $table) {
            $table->string('company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('company');
        });

        Schema::table('vacation_application_documents', function (Blueprint $table) {
            $table->dropColumn('company');
        });
    }
};
