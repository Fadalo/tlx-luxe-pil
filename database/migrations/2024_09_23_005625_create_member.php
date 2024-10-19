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
        Schema::create('member', function (Blueprint $table) {
            $table->id(); // Primary key is automatically set as id()
            $table->string('phone_no')->unique(); // Ensure phone_no is unique
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('pin');
            $table->timestamp('join_date')->nullable();
            $table->timestamp('actived_date')->nullable();
            $table->string('referal_by')->nullable();

            // System
            $table->enum('status_document', ['draft', 'locked'])->nullable()->default('draft'); // draft,locked
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable(); 
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
