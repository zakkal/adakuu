<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // e.g. "Gemini Pro 3 Bulan"
            $table->decimal('price', 12, 2);
            $table->string('badge')->nullable(); // e.g. 'PROMO', 'SOLD OUT'
            $table->boolean('is_available')->default(true);
            $table->text('description')->nullable();
            $table->text('terms')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
