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
        Schema::table('package_types', function (Blueprint $table) {
            $table->dropColumn(['color', 'sort_order', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_types', function (Blueprint $table) {
            $table->string('color')->default('primary')->after('icon');
            $table->integer('sort_order')->default(0)->after('description');
            $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }
};
