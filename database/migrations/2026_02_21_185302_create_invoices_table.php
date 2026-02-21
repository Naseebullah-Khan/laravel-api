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
        Schema::create(table: 'invoices', callback: function (Blueprint $table): void {
            $table->id();
            $table->integer(column: "customer_id");
            $table->integer(column: "amount");
            $table->string(column: "status"); // Bailed or paid or void
            $table->dateTime(column: "bailed_date");
            $table->dateTime(column: "paid_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
