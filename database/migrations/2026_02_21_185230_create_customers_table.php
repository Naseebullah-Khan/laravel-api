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
        Schema::create(table: 'customers', callback: function (Blueprint $table): void {
            $table->id();
            $table->string(column: "name");
            $table->string(column: "type"); // Individual or Business
            $table->string(column: "email");
            $table->string(column: "address");
            $table->string(column: "city");
            $table->string(column: "state");
            $table->string(column: "postal_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'customers');
    }
};
