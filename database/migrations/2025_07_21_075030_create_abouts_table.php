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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('Experience');
            $table->integer('client')->default('0');
            $table->string('point_title')->nullable();
            $table->string('point_description')->nullable();
            $table->json('point_1')->nullable();
            $table->json('point_2')->nullable();
            $table->json('point_3')->nullable();
            $table->json('point_4')->nullable();// Assuming this is an integer field for years of experience
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
