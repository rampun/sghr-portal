<?php

use App\Enums\ExperienceLevelEnum;
use App\Enums\IndustryEnum;
use App\Enums\Jobs\AdDurationEnum;
use App\Enums\Jobs\LocationEnum;
use App\Enums\Jobs\StatusEnum;
use App\Enums\Jobs\TypeEnum;
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
        Schema::create('job_ads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained();
            $table->string('title');
            $table->text('description');
            $table->enum('experience', ExperienceLevelEnum::cases())->nullable();
            $table->enum('industry', IndustryEnum::cases())->nullable();
            $table->enum('type', TypeEnum::cases())->nullable();
            $table->enum('location', LocationEnum::cases())->nullable();
            $table->integer('salary_min_range')->nullable();
            $table->integer('salary_max_range')->nullable();
            $table->enum('status', StatusEnum::cases())->nullable();
            $table->date('start_date')->nullable();
            $table->enum('duration', AdDurationEnum::cases())->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_ads');
    }
};
