<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->date('order_date');
            $table->date('pickup_date');
            $table->string('order_status');
            $table->string('shipping_address');
            $table->decimal('amount', 10, 2);
            $table->string('payment');
            $table->string('delivery_method');
            $table->string('delivery_fee');
            $table->string('order_notes');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('vendor_id');
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
        Schema::dropIfExists('order');
    }
}
