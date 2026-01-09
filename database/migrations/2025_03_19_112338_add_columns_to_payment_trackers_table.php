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
        Schema::table('payment_trackers', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('policy_no');
            $table->string('broker');
            $table->string('insurer');
            $table->decimal('premium', 10, 2);
            $table->date('last_paid')->nullable();
            $table->decimal('arrears_amount', 10, 2)->default(0);
            $table->integer('payments_missed')->default(0);
            $table->date('meeting_date')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->enum('status', ['open', 'closed']);
            $table->boolean('client_inactive')->default(false);
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_trackers', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn([
                'client_id', 'policy_no', 'broker', 'insurer', 'premium',
                'last_paid', 'arrears_amount', 'payments_missed', 'meeting_date',
                'follow_up_date', 'status', 'client_inactive', 'notes'
            ]);
        });
    }
};

