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
            $table->string('name');
            $table->json('tag')->nullable();
            $table->json('color')->nullable();
            $table->json('size')->nullable();

            $table->decimal('price');
            $table->decimal('discount_price')->nullable();
            $table->integer('discount_price_percentage')->nullable();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('child_category_id')->references('id')->on('child_categories')->onDelete('cascade');
            $table->unsignedBigInteger('child_category_id')->nullable();
            

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->string('image')->nullable();
            $table->json('multi_image')->nullable();

            $table->boolean('status')->default(1);
            $table->text('video_url')->nullable();
            $table->boolean('is_featured')->default(0);
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
