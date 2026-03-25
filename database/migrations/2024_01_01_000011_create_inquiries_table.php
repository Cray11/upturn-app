<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('contact_no')->nullable();
            $table->string('business_name')->nullable();
            $table->string('service_interest')->nullable();
            $table->text('message');
            $table->enum('status', ['new','in_progress','resolved','closed'])->default('new');
            $table->enum('source', ['website','walk_in','referral','social'])->default('website');
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inquiries'); }
};
