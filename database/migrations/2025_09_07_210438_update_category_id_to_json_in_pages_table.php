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
            $table->json('category_ids')->nullable()->after('category_id');
        });

        // Data migration from old column to new column
        \App\Models\Page::whereNotNull('category_id')->each(function ($page) {
            $page->category_ids = [$page->category_id];
            $page->save();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('category_ids');
        });

        // Optional: Data migration back to old column (simplistic: takes the first ID)
        \App\Models\Page::whereNotNull('category_ids')->each(function ($page) {
            $ids = json_decode($page->category_ids);
            if (!empty($ids)) {
                $page->category_id = $ids[0];
                $page->save();
            }
        });
        
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('category_ids');
        });
    }
};
