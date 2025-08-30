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
        Schema::create('subscription_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('slug');
            $table->string('product_identification_no');
            $table->string('product_sku');
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->enum('product_status',['publish','inactive','upcomming','draft'])->default('publish');
            $table->date('publish_date');
            $table->decimal('level_one',10,2)->defaule(0.00);
            $table->decimal('level_two',10,2)->defaule(0.00);
            $table->decimal('level_three',10,2)->defaule(0.00);
            $table->decimal('earning_point',10,2)->defaule(0.00);
            $table->foreignId('product_category')->constrained('categories')->onDelete('cascade');
            $table->foreignId('product_subcategory')->constrained('categories')->onDelete('cascade')->nullable();
            $table->text('tags')->nullable();
            $table->longText('specification_terms')->nullable();
            $table->string('price_currency')->default('USD');
            $table->decimal('monthly_price',10,2)->default(0.00);
            $table->decimal('half_yearly_price',10,2)->default(0.00);
            $table->decimal('yearly_price',10,2)->default(0.00);
            $table->enum('discount_type',['none','fixed','percentage'])->default('none');
            $table->decimal('discount_value',10,2)->default(0.00);
            $table->string('search_vector')->nullable();
            $table->string('e_pdf_url')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_products');
    }
};
