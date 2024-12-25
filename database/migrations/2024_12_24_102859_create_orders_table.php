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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('oid');
            $table->unsignedBigInteger('custid'); 
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending'); // Status with default 'pending'
            $table->timestamps(); 

            
            $table->foreign('custid')->references('custid')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
