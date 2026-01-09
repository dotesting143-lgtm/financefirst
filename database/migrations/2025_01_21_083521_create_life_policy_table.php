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
        Schema::create('life_policy', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id'); // Numeric
            $table->string('type'); // Text
            $table->date('start_date')->nullable(); // Text
            $table->date('renewal_date')->nullable(); // Text
            $table->date('end_date')->nullable(); // Text
            $table->string('term')->nullable(); // Text
            $table->string('curinsurer')->nullable(); // Text
            $table->string('propinsurer')->nullable(); // Text
            $table->string('coveramt_1')->nullable(); // Text
            $table->string('coveramt_2')->nullable(); // Text
            $table->string('specill_1')->nullable(); // Text
            $table->string('specill_2')->nullable(); // Text
            $table->string('specill_type_11')->nullable(); // Text
            $table->string('specill_type_21')->nullable(); // Text
            $table->string('hoscash_1')->nullable(); // Text
            $table->string('hoscash_2')->nullable(); // Text
            $table->string('occclass1_11')->nullable(); // Text
            $table->string('occclass1_21')->nullable(); // Text
            $table->string('acccover_1')->nullable(); // Text
            $table->string('acccover_2')->nullable(); // Text
            $table->string('occclass2_11')->nullable(); // Text
            $table->string('occclass2_21')->nullable(); // Text
            $table->string('height_ft_1')->nullable(); // Text
            $table->string('height_ft_2')->nullable(); // Text
            $table->string('height_in_1')->nullable(); // Text
            $table->string('height_in_2')->nullable(); // Text
            $table->string('height_me_1')->nullable(); // Text
            $table->string('height_me_2')->nullable(); // Text
            $table->string('height_cm_1')->nullable(); // Text
            $table->string('height_cm_2')->nullable(); // Text
            $table->string('weight_st_1')->nullable(); // Text
            $table->string('weight_st_2')->nullable(); // Text
            $table->string('weight_lb_1')->nullable(); // Text
            $table->string('weight_lb_2')->nullable(); // Text
            $table->string('weight_kg_1')->nullable(); // Text
            $table->string('weight_kg_2')->nullable(); // Text
            $table->string('guarantee1')->nullable(); // Text
            $table->string('infprotect1')->nullable(); // Text
            $table->string('startimm1')->nullable(); // Text
            $table->string('index1')->nullable(); // Text
            $table->string('pricepledge1')->nullable(); // Text
            $table->string('monthprem')->nullable(); // Text
            $table->string('payfreq')->nullable(); // Text
            $table->string('upfrontpay1')->nullable(); // Text
            $table->string('numpay')->nullable(); // Text
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
        Schema::dropIfExists('life_policy');
    }
};
