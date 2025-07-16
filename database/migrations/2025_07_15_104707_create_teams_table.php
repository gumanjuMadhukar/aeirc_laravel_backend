<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('image'); 
            $table->string('name');
            $table->string('position');
            $table->text('description')->nullable();

            // Social media links (optional)
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('updated_by')->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
