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
            $table->json('sliders')->nullable()->after('slider_image_path');
        });

        // Basic data migration: combine old slider fields into the new JSON structure
        \App\Models\Page::whereNotNull('slider_title')
            ->orWhereNotNull('slider_description')
            ->orWhereNotNull('slider_image_path')
            ->each(function ($page) {
                $page->sliders = [
                    [
                        'title' => $page->slider_title,
                        'description' => $page->slider_description,
                        'image_path' => $page->slider_image_path
                    ]
                ];
                $page->save();
            });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['slider_title', 'slider_description', 'slider_image_path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('slider_title')->nullable();
            $table->text('slider_description')->nullable();
            $table->string('slider_image_path')->nullable();
        });

        // Note: Reversing this migration will lose data from multi-sliders.
        // It will only attempt to restore the first slider from the JSON array.
        \App\Models\Page::whereNotNull('sliders')->each(function ($page) {
            $sliders = json_decode($page->sliders, true);
            if (!empty($sliders) && isset($sliders[0])) {
                $page->slider_title = $sliders[0]['title'] ?? null;
                $page->slider_description = $sliders[0]['description'] ?? null;
                $page->slider_image_path = $sliders[0]['image_path'] ?? null;
                $page->save();
            }
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('sliders');
        });
    }
};
