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
        Schema::create('inv_inventory_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name', 250);
            $table->text('item_description');
            $table->integer('item_quantity');
            $table->decimal('item_price ', 10);
            $table->bigInteger('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_inventory_items');
    }
};
