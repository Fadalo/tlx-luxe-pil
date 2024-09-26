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
        Schema::create('instructor_scheadule', function (Blueprint $table) {
            $table->id(); // Primary key auto-generated
            $table->unsignedBigInteger('instructor_contract_id');
            $table->foreign('instructor_contract_id')->references('id')->on('instructor_contract')->onDelete('cascade');
           

            $table->string('scheadule_day'); // Monday - Friday
            $table->string('scheadule_time'); // 08:00 - 21:00
            
            

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
        Schema::dropIfExists('instructor_scheadule');
    }
};
