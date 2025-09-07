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
        // Check if the column already exists before trying to add it
        if (!Schema::hasColumn('pages', 'settings_order')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->json('settings_order')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('pages', 'settings_order')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('settings_order');
            });
        }
    }
};