<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('department')->nullable();
            $table->string('location')->default('Valenzuela City');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->enum('employment_type', ['full_time','part_time','contractual','internship'])->default('full_time');
            $table->enum('status', ['draft','open','closed'])->default('draft');
            $table->date('deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('job_postings'); }
};
