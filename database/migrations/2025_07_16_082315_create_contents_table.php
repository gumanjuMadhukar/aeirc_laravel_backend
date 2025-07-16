<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            $table->string('headings');
            $table->string('sub_headings');

            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->json('features')->nullable(); // Store as JSON array

            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->enum('status', ['active', 'inactive']);

            $table->string('component'); // e.g., services, whyus, faq, products

            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
