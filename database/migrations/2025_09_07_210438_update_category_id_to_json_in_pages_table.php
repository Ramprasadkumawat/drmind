<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Page;

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
        Page::whereNotNull('category_id')->each(function ($page) {
            $page->category_ids = [$page->category_id];
            $page->save();
        });

        Schema::table('pages', function (Blueprint $table) {
            // STEP 1: Drop the foreign key constraint first!
            $table->dropForeign(['category_id']);

            // STEP 2: Now you can safely drop the column
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

            // Re-add the foreign key constraint if you roll back
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
        
        // Optional: Data migration back to old column
        Page::whereNotNull('category_ids')->each(function ($page) {
            if (!empty($page->category_ids)) {
                $page->category_id = $page->category_ids[0];
                $page->save();
            }
        });
        
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('category_ids');
        });
    }
};
