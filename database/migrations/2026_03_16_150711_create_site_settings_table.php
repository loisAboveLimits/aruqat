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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // General Settings
            $table->json('site_name')->nullable();
            
            // Contact Info
            $table->json('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            
            // Footer Settings
            $table->json('footer_description')->nullable();
            $table->json('footer_nav')->nullable();
            $table->json('copyright_text')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
