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
        Schema::create('middle_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('middle_id');
            $table->foreign('middle_id')->references('id')->on('middles')->onDelete('cascade');
            $table->string('icon',400);
            $table->string('title');
            $table->string('description');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('middle_points');
    }
};
