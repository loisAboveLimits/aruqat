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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->json('hero_title')->nullable();
            $table->json('content')->nullable();
            
            // Vision Tab
            $table->json('vision_title')->nullable();
            $table->json('vision_content')->nullable();
            
            // Clients Tab
            $table->json('clients_title')->nullable();
            $table->json('clients_content')->nullable();
            
            // Goal Tab
            $table->json('goals_title')->nullable();
            $table->json('goals_content')->nullable();

            // SEO Section
            $table->json('seo_badge')->nullable();
            $table->json('seo_tab_title')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('canonical_url')->nullable();

            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            $table->string('robots')->default('index,follow');  
            
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
