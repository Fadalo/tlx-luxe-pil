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
            $table->text('remark')->nullable(); // Nullable if remark is optional
            $table->integer('status')->nullable(); 
            
            // Foreign key for instructor_id (fixed the table name)
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructor')->onDelete('cascade');
            
            // Foreign key for package_id
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('package')->onDelete('cascade');
            
            $table->date('start_datetime')->nullable();
            $table->date('end_datetime')->nullable();
            $table->integer('qty_book')->default(0); 
            $table->integer('qty_max')->default(8); 
            

            $table->enum('status_document', ['draft', 'locked'])->nullable()->default('draft');
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
        Schema::dropIfExists('batch');
    }
};
