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
        Schema::create('userinfo', function (Blueprint $table) {
            $table->id('uinfoid'); 
            $table->unsignedBigInteger('uid'); 
            $table->string('name');
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female', 'other']); 
            $table->string('contact')->unique(); 
            $table->date('dob'); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('uid')->references('uid')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userinfo');
    }
};
