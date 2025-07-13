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
        Schema::table('whyus', function (Blueprint $table) {
            $table->dropcolumn(['whyus_component_title', 'whyus_title', 'whyus_description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whyus', function (Blueprint $table) {
            $table->string('whyus_component_title')->nullable();
            $table->string('whyus_title')->nullable();
            $table->string('whyus_description')->nullable();
        });
    }
};
