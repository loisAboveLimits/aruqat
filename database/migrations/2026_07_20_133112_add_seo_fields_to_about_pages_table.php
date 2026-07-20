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
        Schema::table('about_pages', function (Blueprint $table) {
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->json('canonical_url')->nullable();

            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();

            $table->json('twitter_title')->nullable();
            $table->json('twitter_description')->nullable();

            $table->json('robots')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->json('canonical_url')->nullable();

            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();

            $table->json('twitter_title')->nullable();
            $table->json('twitter_description')->nullable();

            $table->json('robots')->nullable();
        });
    }
};
