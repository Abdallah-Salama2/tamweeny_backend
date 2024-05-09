<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 100);
            $table->integer('product_type');
            $table->string('product_image', 200);
            $table->string('image_extension', 10)->default('jpg');
            $table->text('description');
            $table->integer('stock_quantity');
            $table->decimal('points_price', 10, 2);
//            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('cat_id')->constrained('categories')->cascadeOnDelete();
            $table->integer('favorite_count');
            $table->integer('order_count');
            $table->timestamp('created_at')->useCurrent(); // Set timestamps to use current time
            $table->timestamp('updated_at')->useCurrent(); // Set timestamps to use current time

//            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
