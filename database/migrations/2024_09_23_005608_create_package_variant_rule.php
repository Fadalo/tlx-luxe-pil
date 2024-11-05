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
            $table->string('events')->nullable();
            $table->string('apply4')->nullable();
            $table->unsignedBigInteger('rule_id') ;
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
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
        Schema::dropIfExists('package_variant_rule');
    }
};
