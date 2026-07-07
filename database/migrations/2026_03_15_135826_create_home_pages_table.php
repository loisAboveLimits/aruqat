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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->json('hero_title')->nullable();
            $table->json('hero_subtitle')->nullable();
            $table->json('hero_cta_label')->nullable();
            $table->string('hero_cta_url')->nullable();
            $table->json('hero_secondary_cta_label')->nullable();
            $table->string('hero_secondary_cta_url')->nullable();
            
            // About Section
            $table->json('about_badge')->nullable();
            $table->json('about_title')->nullable();
            $table->json('about_description')->nullable();
            $table->json('about_cta_label')->nullable();
            $table->string('about_cta_url')->nullable();
            
            // Goal Section
            $table->json('goal_badge')->nullable();
            $table->json('goal_title')->nullable();
            $table->json('goal_description')->nullable();
            $table->json('goal_cta_label')->nullable();
            $table->string('goal_cta_url')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
