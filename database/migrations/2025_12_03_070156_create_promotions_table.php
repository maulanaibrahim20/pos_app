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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('cascade'); // null = semua cabang
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['percentage', 'fixed_amount', 'buy_x_get_y', 'free_item']);
            $table->decimal('discount_value', 15, 2)->default(0);
            $table->decimal('min_purchase', 15, 2)->default(0);
            $table->decimal('max_discount', 15, 2)->nullable();
            $table->integer('usage_limit')->nullable(); // max berapa kali bisa dipakai
            $table->integer('usage_count')->default(0);
            $table->boolean('is_member_only')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time')->nullable(); // untuk happy hour
            $table->time('end_time')->nullable();
            $table->json('applicable_days')->nullable(); // ["monday", "tuesday"]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
