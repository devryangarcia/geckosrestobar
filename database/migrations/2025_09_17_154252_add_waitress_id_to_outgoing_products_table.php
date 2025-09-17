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
        Schema::table('outgoing_products', function (Blueprint $table) {
            $table->foreignId('waitress_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('ld_qty')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outgoing_products', function (Blueprint $table) {
            $table->dropForeign(['waitress_id']);
            $table->dropColumn('waitress_id');
        });
    }
};
