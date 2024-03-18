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
            $table->bigInteger('national_id')->unique();
            $table->string('name', 100)->nullable();
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->string('phone_number', 15);
            $table->string('city_state', 100);
            $table->string('street', 255);
            $table->date('birth_date');
            $table->integer('user_type')->default(1);
            $table->decimal('latitude', 10, 8)->default(10.20000000);
            $table->decimal('longitude', 11, 8)->default(10.20000000);
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
