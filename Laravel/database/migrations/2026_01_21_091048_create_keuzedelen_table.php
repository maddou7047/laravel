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
        Schema::create('keuzedelen', function (Blueprint $table) {
            $table->id();
            $table->string('Code')->unique();
            $table->string('Name');
            $table->text('Description');
            $table->text('Content')->nullable();

            $table->integer('MaxStudents')->default(30);
            $table->integer('MinStudents')->default(15);

            $table->boolean('IsActive')->default(true);
            $table->boolean('IsRepeatable')->default(false);

            $table->integer('Periode'); // Periode 1-4

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuzedelen');
    }
};
