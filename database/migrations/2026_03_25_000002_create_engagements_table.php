<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engagements', function (Blueprint $table): void {
            $table->id();
            $table->string('section', 50);
            $table->string('label')->nullable();
            $table->string('title');
            $table->text('description');
            $table->json('images')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engagements');
    }
};
