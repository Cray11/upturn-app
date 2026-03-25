<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['coworking','virtual_office','meeting_room']);
            $table->text('description')->nullable();
            $table->unsignedInteger('capacity')->default(1);
            $table->decimal('price_per_hour', 10, 2)->nullable();
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('spaces'); }
};
