<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            // Drop the boolean column
            $table->dropColumn('is_active');

            // Add the new status enum column, default active
            $table->enum('status', ['active', 'inactive'])->default('active')->after('order');
        });
    }

    public function down(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            // Drop status column
            $table->dropColumn('status');

            // Add back the is_active boolean, default true
            $table->boolean('is_active')->default(true)->after('order');
        });
    }
};

?>