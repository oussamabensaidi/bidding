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
        Schema::table('items', function (Blueprint $table) {
            $table->enum('shipping_status', ['Pending', 'Shipped', 'Delivered'])->default('Pending');
        });

        Schema::table('winners', function (Blueprint $table) {
            $table->dropColumn('final_bid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('shipping_status');
        });

        Schema::table('winners', function (Blueprint $table) {
            $table->integer('final_bid')->nullable();
        });
    }
};
