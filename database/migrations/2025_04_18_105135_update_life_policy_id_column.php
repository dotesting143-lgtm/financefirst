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
        DB::statement('ALTER TABLE life_policy MODIFY id BIGINT UNSIGNED');

        // Step 2: Drop the primary key
        Schema::table('life_policy', function (Blueprint $table) {
            $table->dropPrimary();
        });

        // Step 3: Re-add id as primary key (without auto-increment)
        Schema::table('life_policy', function (Blueprint $table) {
            $table->primary('id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Drop the primary key
        Schema::table('life_policy', function (Blueprint $table) {
            $table->dropPrimary();
        });

        // Step 2: Restore id as auto-increment primary key
        DB::statement('ALTER TABLE life_policy MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
    }
};
