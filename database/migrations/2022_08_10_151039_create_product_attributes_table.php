<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('attribute_id')->nullable();
            $table->string('attribute_value_name')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->double('quantity')->nullable();
            $table->double('vendor_price')->nullable();
            $table->double('stock_price')->nullable();
            $table->double('discount')->nullable();
            $table->double('selling_price')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('is_deleted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
};
