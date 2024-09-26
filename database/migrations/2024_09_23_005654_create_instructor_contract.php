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
        Schema::create('instructor_contract', function (Blueprint $table) {
            $table->id(); // Primary key auto-generated
            $table->string('name');
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructor')->onDelete('cascade');
            $table->unsignedBigInteger('package_variant_id');
            $table->foreign('package_variant_id')->references('id')->on('package_variant')->onDelete('cascade');
            
            $table->date('contract_activated_date')->nullable(); 
            $table->date('contract_start_date')->nullable(); 
            $table->date('contract_end_date')->nullable(); 
            $table->string('remark')->nullable(); 
            
            
            // System
            $table->string('status_document');
            $table->unsignedBigInteger('created_by')->nullable(); // Foreign key, admin/user who created
            $table->unsignedBigInteger('updated_by')->nullable(); // Foreign key, admin/user who updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('instructor_contract');
    }
};
