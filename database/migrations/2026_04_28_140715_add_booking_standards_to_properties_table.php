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
        Schema::table('properties', function (Blueprint $table) {
            $table->time('check_in_time')->nullable()->after('timezone');
            $table->time('check_out_time')->nullable()->after('check_in_time');
            $table->string('default_currency', 3)->default('USD')->after('check_out_time');
            $table->decimal('tax_rate', 5, 2)->nullable()->after('default_currency'); // percent, e.g. 10.00
            $table->text('cancellation_policy')->nullable()->after('tax_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'check_in_time',
                'check_out_time',
                'default_currency',
                'tax_rate',
                'cancellation_policy',
            ]);
        });
    }
};
