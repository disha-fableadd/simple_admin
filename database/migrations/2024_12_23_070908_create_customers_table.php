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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('custid');
            $table->string('fname'); 
            $table->string('lname');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('contact')->unique(); 
            $table->string('email')->unique(); 
            $table->text('address')->nullable(); 
            $table->string('city'); 
            $table->string('state'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
