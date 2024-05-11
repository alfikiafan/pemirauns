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
        Schema::create('pemira', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vote');
            $table->enum('faculty',['FMIPA','FATISDA','FEB','FISIP','FT','FSRB','FK','FH','FKIP']); //Need Revise
            $table->text('information');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreign('id_vote')->references('id')->on('vote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemira');
    }
};
