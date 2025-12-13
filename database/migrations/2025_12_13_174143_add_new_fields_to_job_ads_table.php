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
        Schema::table('job_ads', function (Blueprint $table) {
            $table->json('required_skills')->nullable(); // Consider JSON type   
            $table->unsignedInteger('no_of_employee');
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_ads', function (Blueprint $table) {
            //
        });
    }
};
