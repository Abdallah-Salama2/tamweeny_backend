<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
//    public function up()
//    {
//        Schema::create('token_metadata', function (Blueprint $table) {
//            $table->id();
//            $table->bigInteger('token_id');
//            $table->json('metadata');
//            $table->timestamps();
//
//            $table->foreign('token_id')->references('id')->on('personal_access_tokens')->onDelete('cascade')->onUpdate('restrict');
//        });
//    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_metadata');
    }
};
