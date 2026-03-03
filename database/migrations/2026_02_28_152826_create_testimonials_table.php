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
        Schema::create('lafatour_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->foreignId('package_id')->nullable()->constrained('lafatour_packages');
            $table->tinyInteger('rating')->default(5)->comment('1-5 stars');
            $table->text('review');
            $table->date('travel_date')->nullable();
            $table->string('photo')->nullable()->comment('Customer photo');
            $table->string('video_url')->nullable()->comment('Video testimonial URL');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_approved', 'is_featured']);
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lafatour_testimonials');
    }
};
