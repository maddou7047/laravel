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
            $table->enum('Role', ['admin', 'student', 'slb'])->default('student')->after('password');
            $table->string('KlasCode', 20)->nullable()->after('Role');
            $table->string('Opleiding', 100)->nullable()->after('KlasCode');

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['Role', 'KlasCode', 'Opleiding']);
        });
    }
};
