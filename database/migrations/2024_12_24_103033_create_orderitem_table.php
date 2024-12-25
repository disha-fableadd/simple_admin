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
        Schema::create('orderitem', function (Blueprint $table) {
            $table->id('oitemid'); 
            $table->unsignedBigInteger('oid');
            $table->unsignedBigInteger('pid');
            $table->integer('qty'); 
            $table->decimal('price', 10, 2); 
            $table->decimal('totalprice', 10, 2); 
            $table->string('image');
            $table->timestamps(); 

            // Foreign key constraints
            $table->foreign('oid')->references('oid')->on('orders')->onDelete('cascade');
            $table->foreign('pid')->references('pid')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitem');
    }
};
