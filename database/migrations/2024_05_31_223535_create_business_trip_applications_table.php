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
        Schema::create('business_trip_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('start_date');
            $table->date('end_date');
            $table->string('status')->default(\Illuminate\Support\Arr::first(config('statuses.applications')));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_trip_applications');
    }
};
