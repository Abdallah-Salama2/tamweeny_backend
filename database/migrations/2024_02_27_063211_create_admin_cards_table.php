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
//        Schema::create('admin_cards', function (Blueprint $table) {
//            $table->id()->from(1);
//            $table->Integer('admin_id');
//            $table->foreign('admin_id')->references('id')->on('governor_admins')->cascadeOnDelete();
//            $table->bigInteger('card_number')->default(0)->unique();
//            $table->bigInteger('card_national_id')->default(0)->unique();
//            $table->string('cardName')->default('');
//            $table->integer('individuals_number')->default(0);
//            $table->bigInteger('tamween_points')->default(0);
//            $table->bigInteger('bread_points')->default(0);
//            $table->string('name');
//            $table->string('gender');
//            $table->string('email')->unique();
//            $table->string('salary');
//
//            $table->string('national_id_card_and_birth_certificate')->nullable();
//            $table->json('followers_national_id_cards_and_birth_certificates')->nullable();
//            $table->timestamps();
//
//
//
//        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_cards', function (Blueprint $table) {
            //
        });
    }
};
