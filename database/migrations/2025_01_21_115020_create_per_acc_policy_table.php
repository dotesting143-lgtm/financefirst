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
        Schema::create('per_acc_policy', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id'); // Numeric
            $table->string('type'); // Text
            $table->date('start_date')->nullable(); // Text
            $table->date('renewal_date')->nullable(); // Text
            $table->date('end_date')->nullable(); // Text
            $table->string('coveramt')->nullable(); // Text
            $table->string('curinsurer')->nullable(); // Text
            $table->string('propinsurer')->nullable(); // Text
            $table->string('propinsurer_num')->nullable(); // Text
            $table->string('bentype')->nullable(); // Text
            $table->string('covtype')->nullable(); // Text
            $table->string('startimm1')->nullable(); // Text
            $table->string('pricepledge1')->nullable(); // Text
            $table->string('monthprem')->nullable(); // Text
            $table->string('payfreq')->nullable(); // Text
            $table->string('upfrontpay1')->nullable(); // Text
            $table->date('fdate')->nullable(); // Text
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
        Schema::dropIfExists('per_acc_policy');
    }
};
