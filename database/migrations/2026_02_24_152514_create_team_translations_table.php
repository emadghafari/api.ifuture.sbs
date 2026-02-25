<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('team_translations', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('team_member_id')->constrained()->cascadeOnDelete();
            $blueprint->string('locale')->index();
            $blueprint->string('name');
            $blueprint->string('role');
            $blueprint->text('bio')->nullable();
            $blueprint->unique(['team_member_id', 'locale']);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_translations');
    }
};
