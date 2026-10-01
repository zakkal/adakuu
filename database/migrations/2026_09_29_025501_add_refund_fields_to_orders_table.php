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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('refund_status')->default('NOT_REQUESTED')->after('order_status');
            $table->text('refund_reason')->nullable()->after('refund_status');
            $table->timestamp('refund_requested_at')->nullable()->after('refund_reason');
            $table->timestamp('refund_processed_at')->nullable()->after('refund_requested_at');
            $table->decimal('refund_amount', 10, 2)->nullable()->after('refund_processed_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['refund_status', 'refund_reason', 'refund_requested_at', 'refund_processed_at', 'refund_amount']);
        });
    }
};
