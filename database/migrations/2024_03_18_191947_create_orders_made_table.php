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
        Schema::create('orders_made', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('product_name', 100);
            $table->integer('quantity');
            $table->float('total_price');
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent(); // Set timestamps to use current time
            $table->timestamp('updated_at')->useCurrent(); // Set timestamps to use current time
//
//            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict')->onUpdate('restrict');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('restrict');
//            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict')->onUpdate('restrict');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_made');
    }
};
