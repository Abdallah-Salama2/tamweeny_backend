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
            $table->foreignId('admin_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->bigInteger('national_id')->nullable()->unique();
            $table->integer('card_number')->nullable();
            $table->string('card_status_text', 50)->default('Pending');
            $table->integer('individuals_number');
            $table->bigInteger('tamween_points')->default(0);
            $table->bigInteger('bread_points')->default(0);
            $table->string('name', 191);
            $table->string('gender', 191);
            $table->string('email', 191)->nullable()->unique();
            $table->string('social_status', 50)->nullable();
            $table->text('phone_number')->nullable();
            $table->string('salary', 191);
            $table->json('national_id_card_and_birth_certificate')->nullable();
            $table->json('followers_national_id_cards_and_birth_certificates')->nullable();
            $table->boolean('flag')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();

//            $table->foreign('admin_id')->references('id')->on('governor_admins')->onDelete('cascade');
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
