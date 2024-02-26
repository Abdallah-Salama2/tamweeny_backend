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
        Schema::table('cards',function (Blueprint $table){
            $table->integer('individuals_number')->change()
                ->default('1');
            $table->integer('bread_points')->change()
                ->default('1');
            $table->integer('tamween_points')->change()
                ->default('1');
        });
    }
};
