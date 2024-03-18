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
        Schema::create('admin_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->integer('card_status')->default(1);
            $table->string('card_status_text', 50)->default('pending');
            $table->integer('individuals_number');
            $table->bigInteger('tamween_points')->default(0);
            $table->bigInteger('bread_points')->default(0);
            $table->string('name', 191);
            $table->string('gender', 191);
            $table->string('email', 191)->nullable()->unique();
            $table->string('social_status', 50)->nullable();
            $table->mediumInteger('phone_number')->nullable();
            $table->string('salary', 191);
            $table->string('national_id_card_and_birth_certificate', 191)->nullable();
            $table->json('followers_national_id_cards_and_birth_certificates')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('governor_admins')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_cards');
    }
};
