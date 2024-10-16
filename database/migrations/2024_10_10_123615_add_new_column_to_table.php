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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('entrance');
            $table->integer('floor');
            $table->integer('flat');
            $table->integer('intercom')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('entrance');
            $table->dropColumn('floor');
            $table->dropColumn('flat');
            $table->dropColumn('intercom');
            $table->dropColumn('delivery_date');
            $table->dropColumn('delivery_time');
        });
    }
};
