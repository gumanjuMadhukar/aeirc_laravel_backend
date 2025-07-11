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
        Schema::create('whyus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('whyus_component_title');
            $table->string('whyus_title');
            $table->string('whyus_description');
            $table->string('item_title');
            $table->string('item_icon');
            $table->string('item_description');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whyus');
    }
};
