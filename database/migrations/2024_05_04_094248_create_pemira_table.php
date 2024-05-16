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
            $table->enum('faculty', [
                'FMIPA', 'FATISDA', 'FEB', 'FISIP', 'FT', 'FSRB', 'FK', 'FH', 'FKIP'
            ]);
            $table->enum('type', ['university', 'faculty']);
            $table->text('information');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
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
