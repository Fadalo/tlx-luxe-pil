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
        Schema::create('inst_pkg_ins_rule_multi', function (Blueprint $table) {
           
            $table->id(); // Primary key auto-generated
            $table->unsignedBigInteger('inst_pkg_ins_rule_id');
            $table->foreign('inst_pkg_ins_rule_id')->references('id')->on('instructor_package_insentif_rule')->onDelete('cascade');
           
            $table->string('name'); 
            $table->string('qty');  // single - bertahap
            $table->string('insentif_value_type');  // percentage - fixrate
            $table->smallinteger('insentif_percentage_value');  // percentage - fixrate
            $table->string('insentif_percentage_value_calculate_from');  // percentage - fixrate
            $table->decimal('insentif_value', 5, 2)->nullable()->default(0.00);
            

           // System
           $table->enum('status_document', ['draft', 'locked'])->nullable()->default('draft');
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
        Schema::dropIfExists('inst_pkg_ins_rule_multi');
    }
};
