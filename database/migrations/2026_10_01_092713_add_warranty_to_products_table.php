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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('has_warranty')->default(false)->after('is_active');
            $table->integer('warranty_days')->nullable()->after('has_warranty');
            $table->text('warranty_terms')->nullable()->after('warranty_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['has_warranty', 'warranty_days', 'warranty_terms']);
        });
    }
};
