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
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('total_shares')->default(1000)->after('current_amount')->comment('Total shares available for the project');
        });

        Schema::table('investments', function (Blueprint $table) {
            $table->integer('shares')->default(1)->after('amount')->comment('Number of shares purchased');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('total_shares');
        });

        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('shares');
        });
    }
};
