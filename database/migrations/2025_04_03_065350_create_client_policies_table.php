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
        Schema::create('client_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->unsignedBigInteger('policy_id');
            $table->string('policy_type');
            $table->string('internal_status')->nullable();
            $table->string('uw_status')->nullable();
            $table->boolean('active')->default(true);
            $table->date('creation_date')->nullable();
            $table->decimal('monthprem', 10, 2)->nullable();
            $table->string('propinsurer')->nullable();
            $table->string('propinsurer_num')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_policies');
    }
};
