<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('athlete_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('jersey_size_id')->constrained();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->timestamp('data_declaration_agreed_at')->nullable();
            $table->timestamp('rules_agreement_agreed_at')->nullable();
            $table->timestamps();

            $table->unique(['athlete_id', 'event_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
