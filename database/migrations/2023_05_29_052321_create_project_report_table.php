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
        Schema::create('project_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('project_id');
            $table->string('title_report')->nullable();
            $table->text('description_report')->nullable();
            $table->date('date_cre_report')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('file_report')->nullable();
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_report');
    }
};
