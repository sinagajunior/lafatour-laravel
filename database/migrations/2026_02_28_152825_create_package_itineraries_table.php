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
        Schema::create('lafatour_package_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('lafatour_packages')->onDelete('cascade');
            $table->integer('day_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('activities')->nullable();
            $table->string('meals')->nullable()->comment('e.g., Breakfast, Lunch, Dinner');
            $table->string('accommodation')->nullable();
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index(['package_id', 'day_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lafatour_package_itineraries');
    }
};
