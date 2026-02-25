<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_translations', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('product_id')->constrained()->cascadeOnDelete();
            $blueprint->string('locale')->index();
            $blueprint->string('title');
            $blueprint->text('description')->nullable();
            $blueprint->unique(['product_id', 'locale']);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
