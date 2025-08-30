<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('slug')->unique();
            $table->string('manufacturar_name')->nullable();
            $table->string('product_identification_no')->nullable();
            $table->string('product_sku')->nullable();
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->enum('product_status', ['draft', 'publish'])->default('publish');
            $table->date('publish_date')->nullable();
            $table->integer('product_stock')->nullable();
            $table->string('level_one')->nullable();
            $table->string('level_two')->nullable();
            $table->string('level_three')->nullable();
            $table->integer('earning_point')->nullable();
            $table->unsignedBigInteger('product_category')->nullable();
            $table->unsignedBigInteger('product_subcategory')->nullable();
            $table->json('tags')->nullable(); // json
            $table->json('specification_terms')->nullable(); // json
            $table->decimal('base_price', 10, 2)->nullable();
            $table->string('price_currency', 10)->default('usd');
            $table->enum('product_discount_type', ['none', 'fixed', 'percentage'])->default('none');
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->enum('product_shipping',['vendor','drmind'])->default('vendor');
            $table->enum('stock_status',['instock','unavailable','to_be_announced'])->default('instock');
            $table->timestamps();

            // Foreign keys
            $table->foreign('product_category')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('product_subcategory')->references('id')->on('categories')->onDelete('set null');

            // Indexes
            $table->index('product_name');
            $table->index('slug');
            $table->index('product_sku');
            $table->index('product_category');
            $table->index('product_subcategory');
            $table->index('manufacturar_name');
            $table->index('product_identification_no');
            $table->index('product_price');
            $table->index('base_price');
            $table->index('product_discount_type');
            $table->index('discount_value');

            // Add FULLTEXT index for full-text search
            $table->fullText(['product_name', 'manufacturar_name', 'description', 'short_description'], 'products_fulltext_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
