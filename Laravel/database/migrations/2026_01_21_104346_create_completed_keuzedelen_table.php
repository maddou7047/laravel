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
        Schema::create('completed_keuzedelen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserId')->constrained('users')->onDelete('cascade'); 
            $table->string('KeuzdeelCode',50);
            $table->timestamp('CompletedAt')->nullable();
            $table->timestamp('ImportedAt')->useCurrent();
            $table->timestamps();


            $table->index(['UserId','KeuzdeelCode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_keuzedelen');
    }
};
