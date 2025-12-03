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
        Schema::create('member_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->onDelete('set null');
            // $table->foreignId('donation_request_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('points'); // bisa positif (earning) atau negatif (redeem/donation)
            $table->decimal('percentage_used', 5, 2)->nullable(); // Persentase yang digunakan saat earning
            $table->decimal('transaction_amount', 15, 2)->nullable(); // Total transaksi saat earning
            $table->enum('type', ['earn', 'redeem', 'expire', 'adjustment', 'donation']);
            $table->text('description')->nullable();
            $table->date('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_points');
    }
};
