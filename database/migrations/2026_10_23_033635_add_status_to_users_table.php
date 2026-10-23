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
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('Pending')->after('role'); // Pending, Verified, Cancel
        });

        // Set status to 'Verified' for users that already have email_verified_at set
        \Illuminate\Support\Facades\DB::table('users')
            ->whereNotNull('email_verified_at')
            ->update(['status' => 'Verified']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
