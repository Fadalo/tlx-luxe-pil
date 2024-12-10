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
            $table->smallInteger('session_duration')->nullable();
            $table->smallInteger('qty_ticket_used')->default(0);
            $table->smallInteger('qty_ticket_available')->default(0);
            $table->string('status_session'); // OnScheadule,Closed,Cancel
            $table->integer('is_member_created'); // 0,1


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
        Schema::dropIfExists('member_package_order_session');
    }
};
