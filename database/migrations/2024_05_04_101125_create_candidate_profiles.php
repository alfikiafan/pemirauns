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
        Schema::create('candidate_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_candidate');
            $table->text('biography');
            $table->integer('year');
            $table->text('vision');
            $table->text('mission');
            $table->timestamps();
            $table->foreign('id_candidate')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_profile');
    }
};
