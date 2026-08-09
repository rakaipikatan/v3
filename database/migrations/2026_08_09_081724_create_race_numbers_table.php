<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('race_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_item_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('bib_number');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('race_numbers');
    }
};
