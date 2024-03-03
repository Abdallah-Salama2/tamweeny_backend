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
        //
//        Schema::table('cart',function (Blueprint $table){
//            $table->integer('product_id');
//            $table->foreign('product_id')->references('Id')->on('prodcts')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
