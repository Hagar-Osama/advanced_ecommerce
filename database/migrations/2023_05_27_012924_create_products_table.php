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
            $table->longText('name');
            $table->longText('slug');
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->integer('qty');
            $table->text('code');
            $table->longText('tags');
            $table->decimal('selling_price');
            $table->decimal('discount_price')->nullable();
            $table->string('hot_deals')->default('inactive');
            $table->string('special_offers')->default('inactive');
            $table->string('special_deals')->default('inactive');
            $table->string('thumbnail');
            $table->string('status')->default('inactive');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->restrictOnDelete();
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
