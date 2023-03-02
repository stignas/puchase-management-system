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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id()->startingValue(1000000);
            $table->string('type',2)->default('PO');
            $table->integer('supp_id')->unsigned();
            $table->foreign('supp_id')->references('id')->on('suppliers');
            $table->date('order_date');
            $table->date('requested_date');
            $table->smallInteger('payment_terms');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
