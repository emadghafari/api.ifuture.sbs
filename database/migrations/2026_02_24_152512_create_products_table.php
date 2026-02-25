<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('slug')->unique();
            $blueprint->string('url')->nullable();
            $blueprint->string('image_path')->nullable();
            $blueprint->boolean('status')->default(true);
            $blueprint->boolean('featured')->default(false);
            $blueprint->integer('sort_order')->default(0);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
