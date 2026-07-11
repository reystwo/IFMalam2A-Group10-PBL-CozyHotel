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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('room_id')->nullable()->after('room_type_id')->constrained()->onDelete('set null');
            $table->foreignId('customer_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
            $table->decimal('total_price', 14, 2)->default(0)->after('room_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropForeign(['customer_id']);
            $table->dropColumn(['room_id', 'customer_id', 'total_price']);
        });
    }
};
