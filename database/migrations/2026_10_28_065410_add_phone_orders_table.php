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
            $table->string('phone')->after('email')->nullable();
            $table->string('payment_method')->after('delivery_address');
            $table->string('payment_status')->after('payment_method');
            $table->string('order_status')->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
            $table->dropColumn('order_status');
        });
    }
};
