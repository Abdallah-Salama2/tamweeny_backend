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
        Schema::create('storeowner', function (Blueprint $table) {
            $table->id();
            $table->integer('tax_registration_number');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('tax_card', 50);
            $table->integer('iii');
            $table->timestamp('created_at')->useCurrent(); // Set timestamps to use current time
            $table->timestamp('updated_at')->useCurrent(); // Set timestamps to use current time

            $table->unique('tax_registration_number');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storeowner');
    }
};
