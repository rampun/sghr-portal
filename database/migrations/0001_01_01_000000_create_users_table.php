<?php

use App\Enums\AdminLevelEnum;
use App\Enums\UserRoleEnum;
use App\Enums\CompanySizeEnum;
use App\Enums\IndustryEnum;
use App\Enums\CountryEnum;
use App\Enums\ExperienceLevelEnum;
use App\Enums\EducationLevelEnum;
use App\Enums\UserStatusEnum;
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
            $table->enum('status', UserStatusEnum::cases())->default(UserStatusEnum::ACTIVE);
            $table->enum('role', UserRoleEnum::cases())->nullable();

            // employer specific fields
            $table->string('company_name')->nullable();
            $table->enum('company_size', CompanySizeEnum::cases())->nullable();
            $table->string('company_website')->nullable();
            $table->text('company_description')->nullable();
            $table->enum('company_industry', IndustryEnum::cases())->nullable();
            $table->enum('company_country', CountryEnum::cases())->nullable();

            // job seeker specific fields
            $table->string('resume_url')->nullable();
            $table->enum('experience_level', ExperienceLevelEnum::cases())->nullable();
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->enum('education_level', EducationLevelEnum::cases())->nullable();
            $table->integer('total_exeperience_years')->nullable();
            $table->decimal('expected_salary', 10, 2)->nullable();
            $table->enum('user_country', CountryEnum::cases())->nullable();
            $table->enum('user_industry', IndustryEnum::cases())->nullable();
            $table->json('user_skills')->nullable(); // Consider JSON type   

            // admin specific fields
            $table->enum('admin_level', AdminLevelEnum::cases())->nullable();
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
