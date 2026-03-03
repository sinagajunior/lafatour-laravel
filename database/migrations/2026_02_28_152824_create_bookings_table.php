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
        Schema::create('lafatour_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('package_id')->constrained('lafatour_packages');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_whatsapp');
            $table->text('customer_address')->nullable();
            $table->string('id_card_number');
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->json('family_info')->nullable()->comment('Family members info for booking');
            $table->enum('payment_status', ['pending', 'down_payment', 'paid', 'overdue'])->default('pending');
            $table->enum('booking_status', ['pending', 'confirmed', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('down_payment', 15, 2)->default(0);
            $table->decimal('down_payment_amount', 15, 2)->nullable();
            $table->decimal('remaining_payment', 15, 2)->default(0);
            $table->date('down_payment_due')->nullable();
            $table->date('full_payment_due')->nullable();
            $table->date('down_payment_paid_at')->nullable();
            $table->date('full_payment_paid_at')->nullable();
            $table->string('payment_method')->nullable();
            $table->json('payment_proof')->nullable()->comment('Uploaded payment proof images');
            $table->text('special_requests')->nullable();
            $table->text('admin_notes')->nullable();
            $table->json('documents')->nullable()->comment('Uploaded documents (KTP, KK, Passport)');
            $table->timestamp('confirmed_at')->nullable();
            $table->integer('confirmed_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['booking_status', 'payment_status']);
            $table->index('booking_number');
            $table->index('customer_email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lafatour_bookings');
    }
};
