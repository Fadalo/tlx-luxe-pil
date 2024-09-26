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
        Schema::create('member_package_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
           
            $table->unsignedBigInteger('package_variant_id');
            $table->foreign('package_variant_id')->references('id')->on('package_variant')->onDelete('cascade');
            
            $table->timestamp('activated_package_started_datetime')->nullable();
            $table->integer('activated_package_due_date');
            $table->timestamp('activated_ticket_started_datetime')->nullable();
            $table->integer('activated_ticket_due_date');
            $table->smallInteger('qty_ticket_used')->default(0);
            $table->smallInteger('qty_ticket_available')->default(0);
           
            $table->string('status_package');
            $table->string('status_payment');
            $table->integer('is_member_created');
          
            // System
            $table->string('status_document');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_package_order');
    }
};
