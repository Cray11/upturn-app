<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table): void {
            $table->string('address')->nullable()->after('contact_no');
            $table->string('transportation_mode')->nullable()->after('address');
            $table->text('professional_summary')->nullable()->after('transportation_mode');
            $table->text('educational_background')->nullable()->after('professional_summary');
            $table->string('recent_company')->nullable()->after('educational_background');
            $table->string('recent_position')->nullable()->after('recent_company');
            $table->text('opportunity_reason')->nullable()->after('recent_position');
            $table->string('best_time_to_contact')->nullable()->after('opportunity_reason');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table): void {
            $table->dropColumn([
                'address',
                'transportation_mode',
                'professional_summary',
                'educational_background',
                'recent_company',
                'recent_position',
                'opportunity_reason',
                'best_time_to_contact',
            ]);
        });
    }
};
