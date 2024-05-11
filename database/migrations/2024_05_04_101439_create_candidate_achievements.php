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
        Schema::create('candidate_achievement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_candidate');
            $table->integer('year');
            $table->string('title');
            $table->enum('type', ['competition', 'organizational', 'volunteer']); //need revise
            $table->foreign('id_candidate')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_achievement');
    }
};
