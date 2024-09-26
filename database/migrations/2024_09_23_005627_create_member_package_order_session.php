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
        Schema::create('member_package_order_session', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_package_order_id');
            $table->foreign('member_package_order_id')->references('id')->on('member_package_order')->onDelete('cascade');
            $table->timestamp('session_date')->nullable();
            $table->smallinteger('session_duration')->nullable();
            $table->smallinteger('qty_ticket_used')->default(0);
            $table->smallinteger('qty_ticket_available')->default(0);
            $table->string('status_session');
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
        Schema::dropIfExists('member_package_order_session');
    }
};
