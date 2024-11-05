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
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
           
            $table->unsignedBigInteger('package_variant_id');
            $table->foreign('package_variant_id')->references('id')->on('package_variant')->onDelete('cascade');
            
            $table->unsignedBigInteger('batch_id');
            //$table->foreign('batch_id')->references('id')->on('batch')->onDelete('cascade');
            
            $table->timestamp('available_package_started_datetime')->nullable();
            $table->smallInteger('available_package_due_date')->default(0);

            $table->timestamp('activated_package_started_datetime')->nullable();
            $table->smallInteger('activated_package_due_date')->default(0);

            $table->smallInteger('qty_ticket_used')->default(0);
            $table->smallInteger('qty_ticket_available')->default(0);
           
            $table->string('status_package'); // Available,Actived,Expired
            $table->string('status_payment'); // NotPaid,Paid,PaidPartialy 
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
        Schema::dropIfExists('member_package_order');
    }
};
