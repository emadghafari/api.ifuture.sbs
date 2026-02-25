<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('type')->default('member'); // founder, developer, manager, etc.
            $blueprint->string('photo_path')->nullable();
            $blueprint->string('facebook_url')->nullable();
            $blueprint->string('twitter_url')->nullable();
            $blueprint->string('linkedin_url')->nullable();
            $blueprint->integer('sort_order')->default(0);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
