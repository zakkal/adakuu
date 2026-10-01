<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('badge')->nullable(); // e.g. 'Populer', 'Rekomendasi', 'Terlaris'
            $table->text('description')->nullable();
            $table->string('logo')->nullable(); // SVG or image name
            $table->string('theme_color')->default('purple'); // purple, green, yellow, etc.
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
