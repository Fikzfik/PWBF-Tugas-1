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
        Schema::create('massage_dokumen', function (Blueprint $table) {
            $table->id('no_mdok');
            $table->string('file');
            $table->string('description');
            $table->timestamps();

            $table->unsignedBigInteger('massage_id')->nullable();
            $table->foreign('massage_id')->references('massage_id')->on('massage')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('massage_dokumen');
    }
};
