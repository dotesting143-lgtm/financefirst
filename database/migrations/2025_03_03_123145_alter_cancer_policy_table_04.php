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
        Schema::table('cancer_policy', function (Blueprint $table) {
            //
            $table->string('propinsurer', 50)->nullable();
            $table->string('propinsurer_num', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cancer_policy', function (Blueprint $table) {
            //
        });
    }
};
