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
        Schema::table('lafatour_packages', function (Blueprint $table) {
            $table->foreignId('package_type_id')->nullable()->after('type')->constrained('package_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lafatour_packages', function (Blueprint $table) {
            $table->dropForeign(['package_type_id']);
            $table->dropColumn('package_type_id');
        });
    }
};
