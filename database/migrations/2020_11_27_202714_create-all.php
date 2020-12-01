<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->integer('weight');
            $table->string('descriptions');
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
            $table->integer('stock');
            $table->timestamps();
        });
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('full_name');
            $table->string('billing_address');
            $table->string('default_shipping_address');
            $table->string('country');
            $table->integer('phone');
            $table->timestamps();
        });
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('option_name');
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->BigInteger('ammount');
            $table->string('shipping_address');
            $table->BigInteger('order_address');
            $table->BigInteger('order_email');
            $table->date('order_date');
            $table->boolean('order_status');
            $table->timestamps();
        });
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')->references('id')->on('options');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->timestamps();
        });
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->decimal('price');
            $table->string('quantity');
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_options');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('options');
    }
}
