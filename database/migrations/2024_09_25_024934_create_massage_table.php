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
        Schema::create('massage', function (Blueprint $table) {
            $table->id('massage_id');
            $table->string('massage_reference');
            $table->string('subject');
            $table->text('text');
            $table->string('massage_text');
            $table->string('massage_status');
            $table->timestamps();

            $table->unsignedBigInteger('no_mk')->nullable();
            $table->foreign('no_mk')->references('no_mk')->on('massage_kategori')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('massage');
    }
};
