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
        Schema::create('instructor_package_insentif_rule', function (Blueprint $table) {
            $table->id(); // Primary key auto-generated
            $table->unsignedBigInteger('instructor_contract_id');
            $table->foreign('instructor_contract_id')->references('id')->on('instructor_contract')->onDelete('cascade');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('package')->onDelete('cascade');
           
            $table->string('name'); 
            $table->string('insentif_type');  // single - multi
            $table->string('insentif_value_type');  // percentage - fixrate
            $table->string('insentif_percentage_value');  // percentage - fixrate
            $table->string('insentif_percentage_value_calculate_from');  // percentage - fixrate
            
            $table->string('insentif_value');
            
            
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
        Schema::dropIfExists('instructor_package_insentif_rule');
    }
};
