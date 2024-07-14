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
        Schema::table('inv_inventory_items', function (Blueprint $table) {
            $table->foreign(['created_by'], 'createdByref')->references(['id'])->on('inv_users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inv_inventory_items', function (Blueprint $table) {
            $table->dropForeign('createdByref');
        });
    }
};
