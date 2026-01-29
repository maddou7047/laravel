<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserId')->constrained('users')->onDelete('cascade');
            $table->foreignId('KeuzdeelId')->constrained('keuzedelen')->onDelete('cascade');
            $table->enum('Status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamp('EnrolledAt')->useCurrent();
            $table->timestamps();

            // Prevent duplicate enrollments
            $table->unique(['UserId', 'KeuzdeelId']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
