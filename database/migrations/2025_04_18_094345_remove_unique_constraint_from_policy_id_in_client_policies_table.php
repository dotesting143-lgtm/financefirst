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
        Schema::table('client_policies', function (Blueprint $table) {
            //
            $table->dropUnique(['policy_id']);
            $table->unsignedBigInteger('policy_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_policies', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('policy_id')->nullable(false)->change();
            $table->unique('policy_id');
        });
    }
};
