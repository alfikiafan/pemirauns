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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('president_candidate_id')->constrained();
            $table->foreignId('vice_president_candidate_id')->constrained();
            $table->foreignId('election_id')->constrained();
            $table->string('video');
            $table->string('vision');
            $table->string('mission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate');
    }
};
