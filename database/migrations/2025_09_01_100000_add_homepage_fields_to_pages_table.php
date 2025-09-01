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
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('is_homepage')->default(false)->after('is_published');
            $table->text('slider_text')->nullable();
            $table->string('slider_image_path')->nullable();
            $table->longText('main_paragraph_content')->nullable();
            $table->json('extr-image_paths')->nullable(); // For additional images on the homepage
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['is_homepage', 'slider_text', 'slider_image_path', 'main_paragraph_content', 'extr-image_paths']);
        });
    }
};
