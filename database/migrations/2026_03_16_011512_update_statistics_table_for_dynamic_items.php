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
        Schema::table('statistics', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn(['clients_count', 'years_experience', 'cases_count']);
            
            // Add new flexible columns
            $table->json('title')->after('id');
            $table->integer('value')->after('title')->default(0);
            $table->integer('sort_order')->after('value')->default(0);
            $table->boolean('is_active')->after('sort_order')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn(['title', 'value', 'sort_order', 'is_active']);
            
            $table->integer('clients_count')->default(0);
            $table->integer('years_experience')->default(0);
            $table->integer('cases_count')->default(0);
        });
    }
};
