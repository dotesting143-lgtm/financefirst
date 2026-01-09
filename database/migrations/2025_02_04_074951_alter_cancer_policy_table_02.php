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
            $table->text('needs_obj_text')->nullable()->change();
            $table->text('per_circ_text')->nullable()->change();
            $table->text('fin_sit_text')->nullable()->change();
            $table->text('risk_profile_text')->nullable()->change();
            $table->text('recommend_text')->nullable()->change();
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
