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
        Schema::create('package_variant_rule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_variant_id');
            $table->foreign('package_variant_id')->references('id')->on('package_variant')->onDelete('cascade');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('module'); // Member Package
            $table->string('field'); 
            $table->string('type'); 
            
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
        Schema::dropIfExists('package_variant_rule');
    }
};
