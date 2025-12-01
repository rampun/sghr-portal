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
        Schema::create('users', function (Blueprint $table) {
            // common fields
            $table->uuid('id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->string('status')->nullable();
            $table->string('role')->nullable();

            // employer specific fields
            $table->string('company_name')->nullable();
            $table->string('company_size')->nullable();
            $table->string('company_website')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_industry')->nullable();
            $table->string('company_country')->nullable();

            // job seeker specific fields
            $table->string('resume_url')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->string('education_level')->nullable();
            $table->integer('total_exeperience_years')->nullable();
            $table->decimal('expected_salary', 10, 2)->nullable();
            $table->string('user_country')->nullable();
            $table->string('user_industry')->nullable();
            $table->json('user_skills')->nullable(); // Consider JSON type   

            // admin specific fields
            $table->string('admin_level')->nullable();
            $table->text('admin_notes')->nullable();

            // common fields
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
