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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // ຕ້ອງມີຂໍ້ມູນ
            $table->string('image')->nullable(); // ->nullable() ສາມາດເປັນຄ່າຫວ່າງ
            $table->integer('qty');
            $table->integer('price_buy');
            $table->integer('price_sell');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
