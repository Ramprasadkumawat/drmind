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
            $table->longText('content')->nullable()->after('slug');
            $table->dropColumn(['slider_content', 'paragraph_content']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('slider_content')->nullable()->after('slug');
            $table->text('paragraph_content')->nullable()->after('slider_content');
            $table->dropColumn('content');
        });
    }
};
