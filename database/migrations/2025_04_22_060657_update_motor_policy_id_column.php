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
        DB::statement('ALTER TABLE motor_policy MODIFY id BIGINT UNSIGNED');

        Schema::table('motor_policy', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('motor_policy', function (Blueprint $table) {
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motor_policy', function (Blueprint $table) {
            $table->dropPrimary();
        });

        DB::statement('ALTER TABLE motor_policy MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
    }
};
