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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('store_name', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone_number', 100)->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('valid')->nullable();
            $table->boolean('request')->default(0);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamp('created_at')->useCurrent(); // Set timestamps to use current time
            $table->timestamp('updated_at')->useCurrent(); // Set timestamps to use current time

//            $table->foreign('owner_id')->references('id')->on('storeowner')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
