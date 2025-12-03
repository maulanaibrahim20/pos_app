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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->string('employee_code')->unique(); // e.g., EMP-001
            $table->string('position'); // Jabatan: Manager, Kasir, Chef, Waiter, dll
            $table->string('id_card_number')->nullable(); // NIK/KTP
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();

            // Employment Details
            $table->date('join_date');
            $table->date('end_date')->nullable();
            $table->enum('employment_status', ['permanent', 'contract', 'internship', 'part_time'])->default('permanent');

            // Salary & Benefits
            $table->decimal('basic_salary', 15, 2)->default(0);
            $table->decimal('transport_allowance', 15, 2)->default(0);
            $table->decimal('meal_allowance', 15, 2)->default(0);
            $table->decimal('other_allowance', 15, 2)->default(0);
            $table->text('allowance_notes')->nullable();

            // Working Hours
            $table->time('work_start_time')->nullable(); // Jam masuk kerja
            $table->time('work_end_time')->nullable(); // Jam pulang kerja
            $table->json('working_days')->nullable(); // ["monday", "tuesday", "wednesday", ...]

            // Bank Account (untuk gaji)
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_holder')->nullable();

            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
