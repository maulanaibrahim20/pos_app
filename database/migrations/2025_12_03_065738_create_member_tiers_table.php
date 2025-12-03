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
        Schema::create('member_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bronze, Silver, Gold, Platinum
            $table->integer('min_points')->default(0);
            $table->integer('max_points')->nullable();
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->decimal('point_multiplier', 5, 2)->default(1.00); // 1.5x points
            $table->text('benefits')->nullable(); // JSON: ["Free delivery", "Birthday gift"]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_tiers');
    }
};
