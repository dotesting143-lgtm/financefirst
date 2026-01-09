<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('client_policies', function (Blueprint $table) {
            $table->boolean('left_our_agency')->default(0)->after('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('client_policies', function (Blueprint $table) {
            $table->dropColumn('left_our_agency');
        });
    }
};
