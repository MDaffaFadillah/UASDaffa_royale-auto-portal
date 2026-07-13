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
        Schema::create('luxury_cars', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('model_name', 100);
    $table->string('tag_line', 200)->nullable();
    $table->text('description')->nullable();
    $table->json('engine_specs')->nullable(); // JSONB equivalent
    $table->json('gallery_images')->nullable(); 
    $table->decimal('indicative_price', 16, 2);
    $table->enum('availability_status', ['available', 'reserved', 'bespoke_in_progress'])->default('available');
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luxury_cars');
    }
};
