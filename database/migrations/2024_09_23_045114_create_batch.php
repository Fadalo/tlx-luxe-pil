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
        Schema::create('batch', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('remark')->nullable(); // Nullable if remark is optional
            $table->string('status');
            
            // Foreign key for instructor_id (fixed the table name)
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructor')->onDelete('cascade');
            
            // Foreign key for package_id
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('package')->onDelete('cascade');
            
            $table->timestamp('start_datetime')->nullable();
            $table->timestamp('end_datetime')->nullable();
            
            $table->string('status_document');
            $table->unsignedBigInteger('created_by')->nullable(); // Replaced `number` with `unsignedBigInteger`
             $table->unsignedBigInteger('updated_by')->nullable(); // Replaced `number` with `unsignedBigInteger`
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
