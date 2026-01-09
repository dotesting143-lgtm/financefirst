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
        Schema::table('clients', function (Blueprint $table) {
            $table->text('home_no')->nullable()->change();
            $table->text('work_no')->nullable()->change();
            $table->text('mobile_no')->nullable()->change();
            $table->text('sec_home_no')->nullable()->change();
            $table->text('sec_work_no')->nullable()->change();
            $table->text('sec_mobile_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
