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
        Schema::create('vote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_candidate');
            $table->unsignedBigInteger('id_pemira');
            $table->date('vote_date');
            $table->string('selfie_picture');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_candidate')->references('id')->on('users');
            $table->foreign('id_pemira')->references('id')->on('pemira');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote');
    }
};
