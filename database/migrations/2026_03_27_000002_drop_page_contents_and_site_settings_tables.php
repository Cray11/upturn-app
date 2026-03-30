<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('page_contents');
        Schema::dropIfExists('site_settings');
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table): void {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->enum('type', ['text', 'image', 'boolean', 'json'])->default('text');
                $table->string('group')->default('general');
                $table->timestamp('updated_at')->nullable();
            });
        }

        if (! Schema::hasTable('page_contents')) {
            Schema::create('page_contents', function (Blueprint $table): void {
                $table->id();
                $table->string('page', 50);
                $table->string('section', 50);
                $table->string('label')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->string('primary_button_label')->nullable();
                $table->string('primary_button_url')->nullable();
                $table->string('secondary_button_label')->nullable();
                $table->string('secondary_button_url')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_published')->default(true);
                $table->timestamps();

                $table->unique(['page', 'section']);
            });
        }
    }
};
