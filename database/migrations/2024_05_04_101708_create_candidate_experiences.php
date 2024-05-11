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
        Schema::create('candidate_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_candidate');
            $table->text('description');
            $table->string('position');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreign('id_candidate')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_experience');
    }
};
