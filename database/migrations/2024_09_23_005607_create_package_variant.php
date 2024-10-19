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
        Schema::create('package_variant', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('package')->onDelete('cascade');
            $table->text('desc')->nullable();
            //$table->integer('package_available2activated_duration')->default(7);
            //$table->integer('package_ticket_duration')->default(45);
            $table->integer('package_qty_ticket')->default(10);

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
        Schema::dropIfExists('package_variant');
    }
};
