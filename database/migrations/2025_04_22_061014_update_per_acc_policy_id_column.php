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
        DB::statement('ALTER TABLE per_acc_policy MODIFY id BIGINT UNSIGNED');

        Schema::table('per_acc_policy', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('per_acc_policy', function (Blueprint $table) {
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('per_acc_policy', function (Blueprint $table) {
            $table->dropPrimary();
        });

        DB::statement('ALTER TABLE per_acc_policy MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
    }
};
