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
        Schema::create('commercial_policy', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id'); // Numeric
            $table->string('type'); // Text
            $table->date('start_date')->nullable(); // Text
            $table->date('renewal_date')->nullable(); // Text
            $table->date('end_date')->nullable(); // Text
            $table->string('term')->nullable(); // Text
            $table->string('busdesc')->nullable(); // Text
            $table->string('curinsurer')->nullable(); // Text
            $table->string('propinsurer')->nullable(); // Text
            $table->string('propinsurer_num')->nullable(); // Text
            $table->string('targetprem')->nullable(); // Text
            $table->string('locdesc')->nullable(); // Text
            $table->string('conwalls')->nullable(); // Text
            $table->string('confloor')->nullable(); // Text
            $table->string('conroof')->nullable(); // Text
            $table->string('constory')->nullable(); // Text
            $table->string('conheattype')->nullable(); // Text
            $table->string('extblank')->nullable(); // Text
            $table->string('secalarm')->nullable(); // Text
            $table->string('seccctv')->nullable(); // Text
            $table->string('secwin')->nullable(); // Text
            $table->string('secdoor')->nullable(); // Text
            $table->string('dambuild')->nullable(); // Text
            $table->string('damfix')->nullable(); // Text
            $table->string('damstock')->nullable(); // Text
            $table->string('damplant')->nullable(); // Text
            $table->string('damgross')->nullable(); // Text
            $table->string('damworkings')->nullable(); // Text
            $table->string('damrent')->nullable(); // Text
            $table->string('damempliab')->nullable(); // Text
            $table->string('damclwage')->nullable(); // Text
            $table->string('damoswage')->nullable(); // Text
            $table->string('damppl')->nullable(); // Text
            $table->string('damturnover')->nullable(); // Text
            $table->string('damcomputer')->nullable(); // Text
            $table->string('dammoney')->nullable(); // Text
            $table->date('claimdate1')->nullable(); // Text
            $table->string('claimdetails1')->nullable(); // Text
            $table->string('claimamt1')->nullable(); // Text
            $table->string('claimreserv1')->nullable(); // Text
            $table->date('claimdate2')->nullable(); // Text
            $table->string('claimdetails2')->nullable(); // Text
            $table->string('claimamt2')->nullable(); // Text
            $table->string('claimreserv2')->nullable(); // Text
            $table->date('claimdate3')->nullable(); // Text
            $table->string('claimdetails3')->nullable(); // Text
            $table->string('claimamt3')->nullable(); // Text
            $table->string('claimreserv3')->nullable(); // Text
            $table->date('claimdate4')->nullable(); // Text
            $table->string('claimdetails4')->nullable(); // Text
            $table->string('claimamt4')->nullable(); // Text
            $table->string('claimreserv4')->nullable(); // Text
            $table->date('claimdate5')->nullable(); // Text
            $table->string('claimdetails5')->nullable(); // Text
            $table->string('claimamt5')->nullable(); // Text
            $table->string('claimreserv5')->nullable(); // Text

            $table->string('pricepledge1')->nullable(); // Text
            $table->string('po_monthprem')->nullable(); // Text
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
        Schema::dropIfExists('commercial_policy');
    }
};
