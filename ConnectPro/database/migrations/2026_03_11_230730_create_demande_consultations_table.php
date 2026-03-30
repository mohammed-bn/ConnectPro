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
        Schema::create('demande_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subject');
            $table->text('message');
            $table->enum('status',['Accepted', 'Refused', 'Pending'])->default('Pending');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('professionnel_id')->constrained('professionnels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_consultations');
    }
};
