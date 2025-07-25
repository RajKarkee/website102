<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->foreignId('position_id')->nullable()->change();
            $table->foreign('position_id')->references('id')->on('positions')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->foreignId('position_id')->nullable(false)->change();
            $table->foreign('position_id')->references('id')->on('positions')->cascadeOnDelete();
        });
    }
};
