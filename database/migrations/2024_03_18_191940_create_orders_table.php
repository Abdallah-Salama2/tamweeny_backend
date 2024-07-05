<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->decimal('order_price', 10, 2);
            $table->string('delivery_status', 50)->default('Pending');
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('store_id')->nullable()->constrained('stores')->cascadeOnDelete();
            $table->foreignId('delivery_id')->nullable()->constrained('users', 'id')
                ->where('user_type', 'delivery')->cascadeOnDelete(); // Constraint added here
            $table->timestamp('created_at')->useCurrent(); // Set timestamps to use current time
            $table->timestamp('updated_at')->useCurrent(); // Set timestamps to use current time

//            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict')->onUpdate('restrict');
//            $table->foreign('delivery_id')->references('id')->on('delivery_guys')->onDelete('restrict')->onUpdate('restrict');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
