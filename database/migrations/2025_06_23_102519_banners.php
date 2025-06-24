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
        //
         Schema::create('banners', static function (Blueprint $table) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('title');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('description'); // For MyISAM use string('guard_name', 25);
            $table->string('category'); // For MyISAM use string('guard_name', 25);
            $table->string('image'); // For MyISAM use string('guard_name', 25);
            $table->string('status'); // For MyISAM use string('guard_name', 25);
            $table->string('updated_by'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('banners');

    }
};
