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
//        Schema::create('governor_admins', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
//            $table->timestamp('created_at')->useCurrent(); // Set timestamps to use current time
//            $table->timestamp('updated_at')->useCurrent(); // Set timestamps to use current time
//
////            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governor_admins');
    }
};
