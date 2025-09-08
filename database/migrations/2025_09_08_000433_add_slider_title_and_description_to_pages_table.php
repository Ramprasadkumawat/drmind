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
            $table->string('slider_title')->nullable()->after('slider_image_path');
            $table->text('slider_description')->nullable()->after('slider_title');
            $table->dropColumn('slider_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('slider_text')->nullable()->after('slider_image_path');
            $table->dropColumn(['slider_title', 'slider_description']);
        });
    }
};
