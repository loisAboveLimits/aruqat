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
        Schema::table('about_sections', function (Blueprint $table) {
            $table->json('badge')->nullable()->after('id');
            $table->json('title')->nullable()->after('badge');
            $table->string('cta_label')->nullable()->after('description');
            $table->string('cta_url')->nullable()->after('cta_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->dropColumn(['badge', 'title', 'cta_label', 'cta_url']);
        });
    }
};
