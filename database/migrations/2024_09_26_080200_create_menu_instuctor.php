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
        Schema::create('menu_instuctor', function (Blueprint $table) {
            $table->id();
            $table->string('menu_type');
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('menu_admin')->onDelete('cascade');

            $table->string('menu_name');
            $table->string('menu_controller');
            $table->string('menu_route');
            $table->string('menu_icon');
            $table->string('menu_parent')->nullable(); // Assuming parent can be nullable
            
            $table->text('remark')->nullable();
        
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
        Schema::dropIfExists('menu_instuctor');
    }
};
