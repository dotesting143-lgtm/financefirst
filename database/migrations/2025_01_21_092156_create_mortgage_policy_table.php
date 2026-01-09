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
        Schema::create('mortgage_policy', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id'); // Numeric
            $table->string('type'); // Text
            $table->date('start_date')->nullable(); // Text
            $table->date('end_date')->nullable(); // Text
            $table->string('term')->nullable(); // Text
            $table->string('monthprem')->nullable(); // Text
            $table->string('coveramt')->nullable(); // Text
            $table->string('propinsurer')->nullable(); // Text
            $table->string('propinsurer_num')->nullable(); // Text
            $table->string('propadd1')->nullable(); // Text
            $table->string('propadd2')->nullable(); // Text
            $table->string('proptype')->nullable(); // Text
            $table->string('proprooms')->nullable(); // Text
            $table->string('propcontype1')->nullable(); // Text
            $table->string('propuse1')->nullable(); // Text
            $table->string('propyear')->nullable(); // Text
            $table->string('propyearsrun')->nullable(); // Text
            $table->string('propprice')->nullable(); // Text
            $table->string('propvalue')->nullable(); // Text
            $table->string('guarname')->nullable(); // Text
            $table->date('guardob')->nullable(); // Text
            $table->string('guaradd1')->nullable(); // Text
            $table->string('guaradd2')->nullable(); // Text
            $table->string('guarhomeno')->nullable(); // Text
            $table->string('guarmobile')->nullable(); // Text
            $table->string('guaroccup')->nullable(); // Text
            $table->string('guarincome')->nullable(); // Text
            $table->string('guarrelapp')->nullable(); // Text
            $table->string('guaremail')->nullable(); // Text
            $table->text('needs_obj_text')->nullable(); // Text
            $table->text('per_circ_text')->nullable(); // Text
            $table->text('fin_sit_text')->nullable(); // Text
            $table->text('risk_profile_text')->nullable(); // Text
            $table->text('recommend_text')->nullable(); // Text
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mortgage_policy');
    }
};
