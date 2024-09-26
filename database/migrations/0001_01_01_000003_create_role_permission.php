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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            
            // Foreign key for role_id
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            
            // Foreign key for menu_id
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menu_admin')->onDelete('cascade');
            
            // Assuming 'rules_name' should be a string
            $table->string('rules_name'); 
            
            $table->text('remark')->nullable(); // Nullable remark field
            $table->string('status_document');

            // Timestamps
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
        Schema::dropIfExists('role_permission');
    }
};
