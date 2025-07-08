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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']); // รายรับ หรือ รายจ่าย
            $table->string('title'); // หัวข้อรายการ
            $table->text('description')->nullable(); // รายละเอียด
            $table->decimal('amount', 10, 2); // จำนวนเงิน
            $table->string('category')->nullable(); // หมวดหมู่
            $table->date('transaction_date'); // วันที่ทำรายการ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
