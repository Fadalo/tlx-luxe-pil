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
        Schema::create('watem', function (Blueprint $table) {
            $table->id();
            $table->text('module')->nullable();
            $table->text('name')->nullable();
            $table->text('templete')->nullable();
           
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on(' users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable(); 
            $table->foreign('updated_by')->references('id')->on(' users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watem');
    }
};
