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
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('left_our_agency')->nullable()->after('scheme_name');
            $table->string('vulnerable_person')->nullable()->after('left_our_agency');

            $table->boolean('marketing_consent')->nullable()->after('vulnerable_person');
            $table->boolean('marketing_email')->nullable()->after('marketing_consent');
            $table->boolean('marketing_post')->nullable()->after('marketing_email');
            $table->boolean('marketing_text')->nullable()->after('marketing_post');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'left_our_agency',
                'vulnerable_person',
                'marketing_consent',
                'marketing_email',
                'marketing_post',
                'marketing_text',
            ]);
        });
    }
};
