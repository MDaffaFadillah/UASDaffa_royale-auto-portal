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
        Schema::create('users', function (Blueprint $table) {
    $table->uuid('id')->primary(); // Menggunakan UUID
    $table->string('full_name', 150);
    $table->string('email', 150)->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('phone_number', 30)->nullable();
    $table->enum('role', ['admin', 'vip'])->default('vip');
    $table->rememberToken();
    $table->timestamps();
        });
    }
};
