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
        Schema::create('instructor', function (Blueprint $table) {
            $table->id(); // Primary key auto-generated
            $table->string('phone_no')->unique(); // Ensures uniqueness but doesn't use it as a primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();;
            $table->string('pin');
            $table->timestamp('join_date')->nullable();
            $table->timestamp('actived_date')->nullable();
            $table->string('status');

            // System
            $table->string('status_document');
            $table->unsignedBigInteger('created_by')->nullable(); 
            $table->unsignedBigInteger('updated_by')->nullable(); // Foreign key, admin/user who updated
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor');
    }
};
