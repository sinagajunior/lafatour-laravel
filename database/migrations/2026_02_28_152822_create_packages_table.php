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
        Schema::create('lafatour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('highlights')->nullable();
            $table->enum('type', ['umroh', 'haji'])->default('umroh');
            $table->string('haji_type')->nullable()->comment('For haji: regular, plus, furoda');
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('early_bird_price', 15, 2)->nullable();
            $table->date('early_bird_until')->nullable();
            $table->integer('duration_days')->default(9);
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('quota')->default(40);
            $table->integer('seats_available')->default(40);
            $table->string('hotel_mekkah')->nullable();
            $table->string('hotel_madinah')->nullable();
            $table->string('airline')->nullable();
            $table->boolean('includes_hotel')->default(true);
            $table->boolean('includes_flight')->default(true);
            $table->boolean('includes_visa')->default(true);
            $table->boolean('includes_meals')->default(true);
            $table->boolean('includes_guide')->default(true);
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'is_active']);
            $table->index('departure_date');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lafatour_packages');
    }
};
