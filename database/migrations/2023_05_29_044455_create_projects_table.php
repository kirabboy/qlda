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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('name_project')->nullable();
            $table->text('description')->nullable();
            $table->string('ref')->nullable();
            $table->text('planning')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('date_cre')->nullable();
            $table->double('version')->nullable();
            $table->tinyInteger('sample_status_MA')->nullable();
            $table->string('file_upload')->nullable();
            $table->text('note')->nullable();
            $table->string('name_CT')->nullable();
            $table->string('company_CT')->nullable();
            $table->string('designtion_CT')->nullable();
            $table->string('mobile_CT')->nullable();
            $table->string('email_CT')->nullable();
            $table->tinyInteger('contract_status')->nullable();
            $table->tinyInteger('material_delivery_Pro')->nullable();
            $table->string('lead_time_Pro')->nullable();
            $table->string('person_in_charge_Ur')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
