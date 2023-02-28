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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->from(100000);
            $table->string('name', 40);
            $table->text('description')->nullable();
            $table->integer('supp_id')->unsigned();
            $table->foreign('supp_id')->references('id')->on('suppliers');
            $table->decimal('cost');
            $table->tinyInteger('VAT')->default('21');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
