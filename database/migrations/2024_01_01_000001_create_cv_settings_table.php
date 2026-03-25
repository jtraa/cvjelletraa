<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cv_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Jelle Traa');
            $table->string('job_title_nl')->default('PHP Developer');
            $table->string('job_title_en')->default('PHP Developer');
            $table->string('dob')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('availability')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('photo')->nullable();
            $table->text('profile_nl')->nullable();
            $table->text('profile_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cv_settings');
    }
};
