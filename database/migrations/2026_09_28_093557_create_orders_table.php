<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // e.g. YP-20260928-001
            $table->foreignId('package_id')->constrained();
            $table->string('customer_name');
            $table->string('customer_whatsapp');
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_method')->default('QRIS');
            $table->enum('payment_status', ['UNPAID', 'PAID', 'EXPIRED', 'FAILED'])->default('UNPAID');
            $table->enum('order_status', ['PENDING', 'PAID', 'PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->text('admin_note')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
