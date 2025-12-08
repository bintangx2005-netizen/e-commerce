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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->integer('brand_id');
            $table->integer('vendor_id')->nullable();
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deal')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_id');
            $table->string('product_tags')->nullable();
            $table->string('product_sizes')->nullable();
            $table->string('product_colors')->nullable();
            $table->string('product_quantity');
            $table->string('selling_price');
            $table->string('discount')->nullable();
            $table->string('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};