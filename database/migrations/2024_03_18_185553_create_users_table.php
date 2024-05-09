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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('national_id')->nullable()->unique();
            $table->string('name', 100)->nullable();
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->string('phone_number', 15)->nullable();
            $table->string('city_state', 100)->nullable();
            $table->string('street', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('user_type')->default("customer");
            $table->decimal('latitude', 10, 8)->nullable()->default(10.20000000);
            $table->decimal('longitude', 11, 8)->nullable()->default(10.20000000);
            $table->json('store_owner_info')->nullable();
            $table->json('delivery_info')->nullable();
            $table->timestamps();
            $table->timestamp('last_login_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
