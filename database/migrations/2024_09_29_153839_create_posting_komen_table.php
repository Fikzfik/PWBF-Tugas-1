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
        Schema::create('posting_komentar', function (Blueprint $table) {
            $table->id('komen_id');
            $table->unsignedBigInteger('posting_id');
            $table->unsignedBigInteger('user_id');
            $table->text('komentar_text')->nullable();
            $table->string('komentar_gambar')->nullable();
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable()->useCurrentOnUpdate();

            // Foreign key to posting table
            $table->foreign('posting_id')->references('posting_id')->on('posting')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_komen');
    }
};
