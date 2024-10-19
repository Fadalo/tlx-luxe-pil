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
        Schema::create('batch_session_attendance_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_session_id');
            $table->foreign('batch_session_id')->references('id')->on('batch_session')->onDelete('cascade');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
            
            $table->timestamp('absen_time')->nullable();

           
            

            // System
            $table->string('status_document');
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
        // 
        Schema::dropIfExists('batch_session_attendance_log');
    }
};
