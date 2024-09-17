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
        Schema::create('menu', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name');
            $table->unsignedBigInteger('id_level')->nullable();
            $table->string('menu_link')->nullable();
            $table->string('menu_icon')->nullable();
            $table->string('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('id_level')->references('id_level')->on('menu_level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
