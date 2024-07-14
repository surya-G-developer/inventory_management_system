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
        Schema::table('inv_activity_log', function (Blueprint $table) {
            $table->foreign(['item_id'], 'itemlink')->references(['id'])->on('inv_inventory_items')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'userlink')->references(['id'])->on('inv_users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inv_activity_log', function (Blueprint $table) {
            $table->dropForeign('itemlink');
            $table->dropForeign('userlink');
        });
    }
};
