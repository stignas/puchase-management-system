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
        Schema::create('receiving_orders', function (Blueprint $table) {
            $table->id()->startingValue(2000000);
            $table->string('type',2)->default('RO');
            $table->integer('supp_id')->unsigned();
            $table->foreign('supp_id')->references('id')->on('suppliers');
            $table->date('order_date');
            $table->date('actual_date');
            $table->bigInteger('po_reference')->unsigned();
            $table->foreign('po_reference')->references('id')->on('purchase_orders');
            $table->string('supplier_so',255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiving_orders');
    }
};
