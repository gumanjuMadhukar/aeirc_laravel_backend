<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('description'); 
            $table->string('description_for_list'); 
            $table->string('list'); 
            $table->string('image');       
            $table->string('title');
            $table->string('service_icon');       
            $table->string('service_name');       
            $table->string('service_description'); 
            $table->string('service_features'); 
            $table->string('service_image'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
